# Install Project
1. Install <a href="https://www.docker.com/">docker</a>
2. clone project<pre><code>git clone https://github.com/topten1222/short-url.git {projectName}</code></pre>
3. go to the directory in which you cloned the project. Run the commands from this directory <pre><code>docker compose up -d</code></pre>
4. execute service php. Run the commands from this firectory <pre><code>docker exec -it {containerNameServicePhp} /bin/sh</code></pre>
5. composer install. Run the commands from this directory <pre><code>composer install</code></pre>
6. rename file env to .env
7. database migration. run the command from this directory <pre><code>php spark migrate</code></pre>
8. open browser http://localhost
# How to check container name
run command from this project
<pre><code>docker-compose ps</code></pre>
