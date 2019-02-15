var __slice = [].slice;

function httpGetAsync(Url, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous
    xmlHttp.send(null);
}

(function($, window) {
    var Heart;

    Heart = (function() {
        Heart.prototype.defaults = {
            rating: void 0,
            numHearts: 5,
            change: function(e, value) {}
        };

        function Heart($el, options) {
            var i, s, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                s = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createHearts();
            this.syncRating();
            this.$el.on('mouseover.heart_rating', 'span', function(e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.heart_rating', function() {
                return _this.syncRating();
            });
            this.$el.on('click.heart_rating', 'span', function(e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('heart_rating:change', this.options.change);
        }

        Heart.prototype.createHearts = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numHearts; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-heart-empty'></span>"));
            }
            return _results;
        };

        Heart.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = rating;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('heart_rating:change', rating);
        };

        Heart.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-heart-empty').addClass('glyphicon-heart');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-heart').addClass('glyphicon-heart-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-heart').addClass('glyphicon-heart-empty');
            }
        };
        return Heart;

    })();
    return $.fn.extend({
        heart_rating: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('heart-rating');
                if (!data) {
                    $(this).data('heart-rating', (data = new Heart($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".heart_rating").heart_rating();
});

$( document ).ready(function() {
    $('.is-heart').on('heart_rating:change', function(e, value){
        console.log(value);
        console.log($('.is-heart').data("id"));
        var id = $('.is-heart').data("id");
        var Url = '/rating/create/'+ id + '/' + value;
        window.location = Url;
       // httpGetAsync(Url, callback);
    });
});

