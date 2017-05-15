Bundles Demo Site
============

This is the code for the demo site for the different Jagilpe Symfony Bundles:

[AjaxBlocksBundle](https://github.com/jagilpe/ajax-blocks-bundle)

[MenuBundle](https://github.com/jagilpe/menu-bundle)

You can access the demo in 

https://demos.gilpereda.com/symfony-bundles

# Installation

To install this site locally simply run the following command in a terminal

```bash
# Clone the repository
git clone https://github.com/jagilpe/bundles-demo.git bundles-demo

# Change to the project's directory
cd bundles-demo

# Install the dependencies
composer install

# Generate and dump the assets
php bin/console assetic:dump

# Start the Symfony server
php bin/console server:start
```

Now you should be able to open the Demo accessing http://127.0.0.1:8000