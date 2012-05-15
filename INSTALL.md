# Installing Development Dependencies

## Languages/Runtimes

I'm going to assume that you already have PHP and PEAR installed. If not, check out "[Installing PHP 5.3 with mysqlnd on Mac OS X with MacPorts](http://blog.ryanparman.com/2009/07/11/installing-php-5-3-with-mysqlnd-on-mac-os-x-with-macports/)".

### MacPorts
First thing to do if you haven't already is to install [MacPorts](http://macports.org). After that, ensure that all of the packages are up-to-date.

	sudo port -d selfupdate

Using this, make sure that you have the following software packages installed.

### Git

[Git](http://git-scm.com) is a distributed version control system made popular by services like [GitHub](http://github.com).
In order to do pretty much anything, you'll need to have Git installed. If you're not sure if you have Git installed,
run the following on the command line.

	git --version

Otherwise, install Git from <http://git-scm.com> or your favorite package management system.

### Subversion

[Subversion](http://subversion.apache.org) is another type of version control system that is used by some of this
web application's dependencies (i.e., Zend Framework).If you're not sure if you have Subversion installed, run the
following on the command line.

	svn --version

Otherwise, install Subversion from <http://subversion.apache.org> or your favorite package management system.

### Ruby

Ruby is a popular programming language. If you're not sure if you have [Ruby](http://ruby-lang.org) installed,
run the following on the command line.

	ruby --version

Otherwise, install Ruby from <http://ruby-lang.org> or your favorite package management system. ([RVM](https://rvm.io/rvm/install/) is highly recommended for this.)

### RubyGems

RubyGems is a package management system for Ruby modules. If you're not sure if you have [RubyGems](http://rubygems.org/pages/download)
installed, run the following on the command line.

	gem --version

Otherwise, install RubyGems from <http://rubygems.org/pages/download> or your favorite package management system.

### Java

Java is another popular programming language. If you're not sure if you have [Java](http://java.com) installed,
run the following on the command line.

	java -version

Otherwise, install Java from <http://java.com> or your favorite package management system.


## Software Packages
### Installing Composer

[Composer](https://github.com/composer/composer/blob/master/README.md) is a tool for dependency management in PHP.
It allows you to declare the dependent libraries your project needs and it will install them in your project for you.
This idea is not new and Composer is strongly inspired by Node's npm and Ruby's Bundler. But there has not been such
a tool for PHP.

To install Composer, you should run the following one-liner.

	curl -s http://getcomposer.org/installer | php -- --install-dir=~/bin

This will install `composer.phar` to `~/bin`. Next, rename `composer.phar` to simply `composer`.

	mv ~/bin/composer.phar ~/bin/composer

Lastly, make sure that `~/bin` has been added to your path (if it hasn't been already).

	export PATH=~/bin:$PATH


### Installing Juicer

[Juicer](https://github.com/cjohansen/juicer) is a tool, written in Ruby, that resolves dependencies in
CSS and JavaScript files before minifying them. This produces a single CSS or JavaScript file that you include
in your website, [reducing the number of HTTP requests](http://developer.yahoo.com/performance/rules.html#num_http)
that need to be made by your site.

To install Juicer, simply install the Gem and its dependencies. You may need to use `sudo`.

	gem install shoulda mocha fakefs redgreen jeweler juicer

Afterwards, install the various compressors.

	juicer install yui_compressor
	juicer install closure_compiler
	juicer install jslint

Look at `public/styles/production.css` and `public/scripts/production.js` to see how dependencies are managed.
