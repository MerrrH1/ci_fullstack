jQuery.extend(jQuery.expr[':'], {
    focusable: function(el, index, selector) {
        return $(el).is('a, button :input, [tabindex]');
    }
});

function isNumber(txt, evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode == 46) {
        if(txt.value.indexOf('.') === -1) {
            return true;
        } else {
            return false;
        }
    } else {
        if(charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
    }
    return true;
}

function isEmptyNumber(v) {
    let type = typeof v;
    if (type === 'undefined') {
        return true;
    }
    if (type === 'boolean') {
        return !v;
    }
    if (v === null) {
        return true;
    }
    if (v === undefined) {
        return true;
    }
    if (v instanceof Array) {
        if (v.length < 1) {
            return true;
        } 
        
        else if (type === 'string') {
            if (v.length < 1) {
                return true;
            }
            if (v === '0') {
                return true;
            }
        } else if (type === 'object') {
            if (Object.keys(v).length < 1) {
                return true;
            }
        } else if (type === 'number') {
            if (v === 0) {
                return true;
            }
        }
        return false;
    }
}

$(document).ready(function() {
    $(document).on('keypress', 'input, select', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $canfocus = $(':focusable');
            var index = $canfocus.index(document.activeElement) + 1;
            if (index >= $canfocus.length) index = 0;
            $canfocus.eq(index).focus();
        }
    });

    $('#harga_jual').on('keyup click change paste input', function(event) {
        $(this).val(function(index, value) {
            if (value != "") {
                var decimalCount;
                value.match(/\./g) === null ? decimalCount = 0 :  decimalCount = value.match(/\./g);

                if (decimalCount.length > 1) {
                    value = value.slice(0, -1);
                }

                var components = value.toString().split('.');
                if (components.length === 1) {
                    components[0] = value;
                    components[0] = components[0].replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
                if (components.length === 2) {
                    components[1] = components[1].replace(/\D/g, '').replace(/^\d{3}$/, '');
                }
                if (components.join('.') != '') {
                    return components.join(',')
                } else {
                    return '';
                }
            }
        });
    });

    $('#harga_beli').on('keyup click change paste input', function(event) {
        $(this).val(function(index, value) {
            if (value != '') {
                var decimalCount;
                value.match(/\./g) === null ? decimalCount = 0 : decimalCount = value.match(/\./g);

                if (decimalCount.length > 1) {
                    value = value.slice(0, -1);
                }

                var components = value.toString().split('.');
                if (components.length === 1) {
                    components[0] = value;
                    components[0] = components[0].replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
                if (components.length === 2) {
                    components[1] = components[1].replace(/\D/g, '').replace(/^\d{3}$/, '');
                }
                if (components.join('.') != '') {
                    return components.join(',')
                } else {
                    return '';
                }
            }
        });
    });

    $('#harga_pokok').on('keyup click change paste input', function(event) {
        $(this).val(function(index, value) {
            if (value != '') {
                var decimalCount;
                value.match(/\./g) === null ? decimalCount = 0 : decimalCount = value.match(/\./g);

                if (decimalCount.length > 1) {
                    value = value.slice(0, -1);
                }

                var components = value.toString().split('.');
                if (components.length === 1) {
                    components[0] = value;
                    components[0] = components[0].replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
                if (components.length === 2) {
                    components[1] = components[1].replace(/\D/g, '').replace(/^\d{3}$/, '');
                }
                if (components.join('.') != '') {
                    return components.join(',')
                } else {
                    return '';
                }
            }
        });
    });
});