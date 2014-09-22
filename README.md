MageSplit
=========

**Overview**

MageSplit is an extremely simple tool for running split tests in Magento.  
The reason that I put it together was that I was just beginning to run
some very simple tests, and wasn't really interested in paying for a
service.

Also, the types of tests that I was doing didn't really require a nice
visual editor, which is usually one of the main features of the A/B
testing services that are out there.

**Installation**

Install [Clean_Util](https://github.com/kalenjordan/cleanutil) - a utilities module that's used to handle a few utilities for the module.

    modman clone cleanutil git@github.com:kalenjordan/cleanutil.git

Include [jquery.cookie](https://github.com/carhartl/jquery-cookie)

Install using modman:

    modman clone magesplit git@github.com:kalenjordan/magesplit.git
    
Then, to create a test, just pop into one of your `phtml` files, and:

    <script type="text/javascript">
        if (typeof(MageSplit) != 'undefined') {
            new MageSplit().run('red_addtocart_button', function() {
                jQuery('button#addtocart').css('color', 'red');
            });
         }
    </script>

**How does it work?**

All that it does is generates a random number per each visitor, storing
it on a cookie.  If it's greater than 0.5, then it enables the experiment.

When the experiment is enabled, the code that you've defined will be run,
and also a custom event will be sent up to Google Analytics, with a category
name of MageSplit, and an event name of "$experimentName: Enabled"
or "$experimentName: Disabled".

So, you get the idea - crazy simple and probably not very useful if you're
doing anything fancy.  But if you're just getting started, may save you
a minute or two fussing around with javascript cookies.

**ProTips**

*1. Use your debug console*

Use your Console to see whether or not the test is enabled.

*2. URL Override*

If you want to force the test to be enabled or disabled, say because you're
tired of randomly opening and closing Incognito windows over and over, 
you can just go to:

    http://www.yourswankymagentoinstall.com/path/?magesplit_red_addtocart_button=1
    
or
    
    http://www.yourswankymagentoinstall.com/path/?magesplit_red_addtocart_button=0
