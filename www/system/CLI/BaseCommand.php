<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeIgniter\CLI;

use Psr\Log\LoggerInterface;
use ReflectionException;
use Throwable;

/**
 * Class BaseCommand
 */
abstract class BaseCommand
{
	/**
	 * The group the command is lumped under
	 * when listing commands.
	 *
	 * @var string
	 */
	protected $group;

	/**
	 * The Command's name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * the Command's usage description
	 *
	 * @var string
	 */
	protected $usage;

	/**
	 * the Command's short description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * the Command's options description
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * the Command's Arguments description
	 *
	 * @var array
	 */
	protected $arguments = [];

	/**
	 * The Logger to use for a command
	 *
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 * Instance of Commands so
	 * commands can call other commands.
	 *
	 * @var Commands
	 */
	protected $commands;

	//--------------------------------------------------------------------
	/**
	 * BaseCommand constructor.
	 *
	 * @param LoggerInterface $logger
	 * @param Commands        $commands
	 */
	public function __construct(LoggerInterface $logger, Commands $commands)
	{
		$this->logger   = $logger;
		$this->commands = $commands;
	}

	//--------------------------------------------------------------------

	/**
	 * Actually execute a command.
	 * This has to be over-ridden in any concrete implementation.
	 *
	 * @param array $params
	 */
	abstract public function run(array $params);

	//--------------------------------------------------------------------

	/**
	 * Can be used by a command to run other commands.
	 *
	 * @param string $command
	 * @param array  $params
	 *
	 * @return mixed
	 * @throws ReflectionException
	 */
	protected function call(string $command, array $params = [])
	{
		return $this->commands->run($command, $params);
	}

	//--------------------------------------------------------------------

	/**
	 * A simple method to display an error with line/file, in child commands.
	 *
	 * @param Throwable $e
	 */
	protected function showError(Throwable $e)
	{
		$exception = $e;
		$message   = $e->getMessage();

		require APPPATH . 'Views/errors/cli/error_exception.php';
	}

	//--------------------------------------------------------------------

	/**
	 * Show Help includes (Usage, Arguments, Description, Options).
	 */
	public function showHelp()
	{
		CLI::write(lang('CLI.helpUsage'), 'yellow');

		if (! empty($this->usage))
		{
			$usage = $this->usage;
		}
		else
		{
			$usage = $this->name;

			if (! empty($this->arguments))
			{
				$usage .= ' [arguments]';
			}
		}

		CLI::write($this->setPad($usage, 0, 0, 2));

		if (! empty($this->description))
		{
			CLI::newLine();
			CLI::write(lang('CLI.helpDescription'), 'yellow');
			CLI::write($this->setPad($this->description, 0, 0, 2));
		}

		if (! empty($this->arguments))
		{
			CLI::newLine();
			CLI::write(lang('CLI.helpArguments'), 'yellow');
			$length = max(array_map('strlen', array_keys($this->arguments)));

			foreach ($this->arguments as $argument => $description)
			{
				CLI::write(CLI::color($this->setPad($argument, $length, 2, 2), 'green') . $description);
			}
		}

		if (! empty($this->options))
		{
			CLI::newLine();
			CLI::write(lang('CLI.helpOptions'), 'yellow');
			$length = max(array_map('strlen', array_keys($this->options)));

			foreach ($this->options as $option => $description)
			{
				CLI::write(CLI::color($this->setPad($option, $length, 2, 2), 'green') . $description);
			}
		}
	}

	//--------------------------------------------------------------------

	/**
	 * Pads our string out so that all titles are the same length to nicely line up descriptions.
	 *
	 * @param string  $item
	 * @param integer $max
	 * @param integer $extra  How many extra spaces to add at the end
	 * @param integer $indent
	 *
	 * @return string
	 */
	public function setPad(string $item, int $max, int $extra = 2, int $indent = 0): string
	{
		$max += $extra + $indent;

		return str_pad(str_repeat(' ', $indent) . $item, $max);
	}

	//--------------------------------------------------------------------

	/**
	 * Get pad for $key => $value array output
	 *
	 * @param array   $array
	 * @param integer $pad
	 *
	 * @return integer
	 *
	 * @deprecated Use setPad() instead.
	 *
	 * @codeCoverageIgnore
	 */
	public function getPad(array $array, int $pad): int
	{
		$max = 0;
		foreach (array_keys($array) as $key)
		{
			$max = max($max, strlen($key));
		}
		return $max + $pad;
	}

	//--------------------------------------------------------------------

	/**
	 * Makes it simple to access our protected properties.
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function __get(string $key)
	{
		if (isset($this->$key))
		{
			return $this->$key;
		}

		return null;
	}

	//--------------------------------------------------------------------

	/**
	 * Makes it simple to check our protected properties.
	 *
	 * @param string $key
	 *
	 * @return boolean
	 */
	public function __isset(string $key): bool
	{
		return isset($this->$key);
	}
}
