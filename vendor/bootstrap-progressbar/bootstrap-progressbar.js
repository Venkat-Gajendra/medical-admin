/*!
 * bootstrap-progressbar v0.8.4 by @minddust
 * Copyright (c) 2012-2014 Stephan Groß
 *
 * http://www.minddust.com/project/bootstrap-progressbar/
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
(function($) {

  'use strict';

  // PROGRESSBAR CLASS DEFINITION
  // ============================

  var Progressbar = function(element, options) {
    this.$element = $(element);
    this.options = this.validateOptions(options);
  };

  Progressbar.defaults = {
    transition_delay: 300,
    refresh_speed: 50,
    display_text: 'none',
    use_percentage: true,
    percent_format: function(percent) { return percent + '%'; },
    amount_format: function(amount_part, amount_max, amount_min) { return amount_part + ' / ' + amount_max; },
    update: $.noop,
    done: $.noop,
    fail: $.noop
  };

  Progressbar.prototype.validateOptions = function(options) {
    options = $.extend({}, Progressbar.defaults, options);

    if (typeof options.percent_format !== 'function') {
      console.error('Invalid option: percent_format must be a function');
      delete options.percent_format;
    }

    if (typeof options.amount_format !== 'function') {
      console.error('Invalid option: amount_format must be a function');
      delete options.amount_format;
    }

    if (typeof options.update !== 'function') {
      console.error('Invalid option: update must be a function');
      delete options.update;
    }

    if (typeof options.done !== 'function') {
      console.error('Invalid option: done must be a function');
      delete options.done;
    }

    if (typeof options.fail !== 'function') {
      console.error('Invalid option: fail must be a function');
      delete options.fail;
    }

    return options;
  };

  Progressbar.prototype.transition = function() {
    var $this = this.$element;
    var $parent = $this.parent();
    var $back_text = this.$back_text;
    var $front_text = this.$front_text;
    var options = this.options;
    var data_transitiongoal = parseInt($this.attr('data-transitiongoal'));
    var aria_valuemin = parseInt($this.attr('aria-valuemin')) || 0;
    var aria_valuemax = parseInt($this.attr('aria-valuemax')) || 100;
    var is_vertical = $parent.hasClass('vertical');
    var update = options.update || Progressbar.defaults.update;
    var done = options.done || Progressbar.defaults.done;
    var fail = options.fail || Progressbar.defaults.fail;

    if (isNaN(data_transitiongoal)) {
      fail('data-transitiongoal not set');
      return;
    }

    var percentage = this.calculatePercentage(data_transitiongoal, aria_valuemin, aria_valuemax);

    this.createTextElements($parent, is_vertical, percentage);

    setTimeout(function() {
      var current_percentage;
      var current_value;
      var this_size;
      var parent_size;
      var text;

      if (is_vertical) {
        $this.css('height', percentage + '%');
      }
      else {
        $this.css('width', percentage + '%');
      }

      var progress = setInterval(function() {
        if (is_vertical) {
          this_size = $this.height();
          parent_size = $parent.height();
        }
        else {
          this_size = $this.width();
          parent_size = $parent.width();
        }

        current_percentage = this.calculatePercentage(this_size, parent_size, aria_valuemin, aria_valuemax);
        current_value = this.calculateValue(current_percentage, aria_valuemin, aria_valuemax);

        if (current_percentage >= percentage) {
          current_percentage = percentage;
          current_value = data_transitiongoal;
          done($this);
          clearInterval(progress);
        }

        if (options.display_text !== 'none') {
          text = options.use_percentage ? options.percent_format(current_percentage) : options.amount_format(current_value, aria_valuemax, aria_valuemin);

          if (options.display_text === 'fill') {
            $this.text(text);
          }
          else if (options.display_text === 'center') {
            $back_text.text(text);
            $front_text.text(text);
          }
        }

        $this.attr('aria-valuenow', current_value);

        update(current_percentage, $this);
      }, options.refresh_speed);
    }, options.transition_delay);
  };

  Progressbar.prototype.calculatePercentage = function(value, min, max) {
    return Math.round(100 * (value - min) / (max - min));
  };

  Progressbar.prototype.calculateValue = function(percentage, min, max) {
    return Math.round(min + percentage / 100 * (max - min));
  };

  Progressbar.prototype.createTextElements = function($parent, is_vertical, percentage) {
    var $back
