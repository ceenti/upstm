# Wordpress React Starter
## DevContainer Enabled Repo

### Directions:

1. Make sure you have both VSCode and Docker installed
2. Create the `.env` file on the root of the repo following the directions to create the missing keys on the `.env.example`file
3. Clone this repo and open it on VSCode, it will ask you if you want to open it it the declared container (answer yes of course)
4. If you are on ARM64/Apple Silicon change the first line on .devcontainer/Dockerfile by appending `-bullseye` to it and rebuild the container
5. Wait for the container images to be downloaded / built, after it the setup.sh script will be run
6. Make sure that Apache is running with `sudo service apache2 status` and start it if neccesary `sudo service apache2 start`
7. Open your browser on http://localhost:8080
8. Open a terminal in VSCode and cd to the web/app/themes/wpreact folder
8. Start hacking. You'll likely only work with the files on the `web/app/themes/wpreact/src` folder
10. You may want to run `npm start watch` for listening to changes in the files of the theme
11. If you need to make changes in the PHP Controllers for the data to be passed to the React pages look under `web/app/themes/wpreact/app/Controllers`


Important: There are 2 important switches on the `.devcontainer/setup.sh` file:

`WP_RESET` (default = `true`) This will empty the tables on the Wordpress Database
`WP_SEED` (default = `true`) This will import an initial set of Posts (9), images, Categories and Tags, as well as the Pages needed to correctly route to the `/blog`, `/exit` and the Privacy Policy pages.


Happy coding!  🙂


