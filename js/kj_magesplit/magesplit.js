function MageSplit()
{
    this._name = null;

    // Ten year cookie duration is what optimizely uses.
    this._cookieDuration = 3650;

    this.run = function(name, callback)
    {
        this._name = name;

        if (this._isTriggered()) {
            _gaq.push(['_trackEvent', 'MageSplit', this._name + ': Enabled']);
            this._log("Enabled (" + this._getRandomNumber() + ")");
            callback();
        } else {
            _gaq.push(['_trackEvent', 'MageSplit', this._name + ': Disabled']);
            this._log("Disabled (" + this._getRandomNumber() + ")");
        }
    };

    this._isTriggered = function()
    {
        if (this._getUrlOverride() !== null) {
            this._log("Overriden by URL");
            return this._getUrlOverride();
        }

        return (this._getRandomNumber() > 0.5);
    };

    this._getRandomNumber = function()
    {
        if (typeof(jQuery.cookie(this._getCookieName())) == 'undefined') {
            var random = Math.random(0, 1);
            jQuery.cookie(this._getCookieName(), random, {expires: this._cookieDuration});
        }

        return jQuery.cookie(this._getCookieName());
    }

    this._getCookieName = function()
    {
        return 'magesplit_' + this._name + '_random_number';
    };

    this._getUrlOverride = function()
    {
        param = window.location.search.substring(1);
        testEnabledParamName = 'magesplit_' + this._name + '=1';
        testDisabledParamName = 'magesplit_' + this._name + '=0';

        if (param == testEnabledParamName) {
            return true;
        } else if (param == testDisabledParamName) {
            return false;
        }

        return null;
    };

    this._log = function(message)
    {
        console.log("Split Test: " + this._name + ": " + message);
    };
}