/**
 * CSSEditor, JS-сценарий v1.5
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2014 OOO «Диафан» (http://diafan.ru)
 */


(function () {

    var content = document.getElementById("csseditor_content"),
            parser = document.getElementById("csseditor_parser"),
            css_fields,
            css_edit = {
                'color': 'Цвет текста',
                'background-color': 'Цвет фона',
                'background': 'Цвет фона',
                'border': 'Цвет границы',
                'border-color': 'Цвет границы',
                'border-bottom-color': 'Цвет нижней границы',
                'border-top-color': 'Цвет верхней границы',
                'border-left-color': 'Цвет левой границы',
                'border-right-color': 'Цвет правой границы',
                'box-shadow': 'Цвет тени',
                'column-rule-color': 'Цвет границы между колонками',
                'outline': 'Цвет линии вокруг',
                'outline-color': 'Цвет линии вокруг'
            };

    function get_css_prop(str) {
        str = str.replace(/\n/g, "|");

        var css_fields = [], match,
                ex2 = /\|?[\.|#]?.*?\{\s?\/\*#(.*?)\*\/\s?\|?(.*?)}\|?/g,
                ex3 = /(.*?)\:(.*?)\;.*?\|?/g;

        while ((match = ex2.exec(str)) !== null) {
            if (match.length !== 3)
                continue;

            var css = {
                name: match[1],
                values: {}
            }, prop;

            while ((prop = ex3.exec(match[2])) !== null) {

                if (prop.length !== 3)
                    continue;

                css.values[prop[1].replace(/\s/g, "")] = prop[2];
            }

            css_fields.push(css);
        }
        
        // console.log(css_fields);

        return css_fields;
    }

    function RGB_HASH(colors) {
        var hash = '#';
        for (var i in colors) {
            var s = parseInt(colors[i], 10).toString(16);
            if(1 === s.length) { s = '0' + s; }
            hash += s;
        }
        
        return hash;
    }

    function HASH_RBG(hash) {
        hash = hash.replace("#", '');
        var rbg = [];
        for (var i = 0; i < hash.length; i += 2) {
            rbg.push(parseInt('0x' + hash.substr(i, 2), 16));
        }
        return rbg;
    }
    
    function replace_regex(value) {
        var ex = [
            /(#[a-f0-9]{3,6})/i,
            /(transparent)/i,
            /rgba?\(\s*((\d{1,3}\s*,?\s*){3}(\s*\,\s*[0-1]\.?\d*))\s*\)/i
        ];  
        
        for(var i in ex) {
           if(ex[i].test(value)) return ex[i];
        }
        return false;
    }


    function create_visual() {
        css_fields = get_css_prop(content.value);
        //console.log(css_fields);
        parser.innerHTML = '';

        for (var i in css_fields) {
            var div = document.createElement("div"),
                    html = '<span class="name">' + css_fields[i].name + '</span><table>',
                    j = 0;


            for (var value in css_fields[i].values) {
                if (css_edit[value])
                {
                    var color = css_fields[i].values[value].match(/(#[a-f0-9]{3,6})/i),
                            transparent = false,
                            opacity = 100;
                    if (!color) {
                        color = css_fields[i].values[value].match(/(transparent)/i);
                        if (color)
                            transparent = true;
                    }
                    if (!color) {
                        color = css_fields[i].values[value].match(/rgba?\(\s*((\d{1,3}\s*,?\s*){3}(\s*\,\s*[0-1]\.?\d*))\s*\)/i);
                        if (!color)
                            continue;

                        var colors = color[1].replace(/\s/g, '').split(",");
                        if (4 === colors.length)
                            opacity = colors.pop() * 100;

                        color[0] = RGB_HASH(colors);
                    }

                    html += '<tr><td>' + css_edit[value] + ':</td>\
                    <td><span data-id="' + i + '-' + j + '" data-field="' + i + '"  title="transparent" class="transparent' + (transparent ? ' active' : '') + '"></span></td>\
                    <td><input class="csseditor_edit color {hash:true}"' + (transparent ? ' disabled="disabled"': '') + ' type="text" pattern="^#[a-fA-F0-9]{3,6}" data-opacity="' + opacity + '" data-field="' + i + '" data-id="' + i + '-' + j + '" data-value="' + value + '" data-old="' + css_fields[i].values[value] + '" value="' + color[0] + '"></td>\
                    <td title="Прозрачность"><input class="opacity"' + (transparent ? ' disabled="disabled"': '') + ' data-id="' + i + '-' + j + '" value="' + opacity + '" type="number" min="0" max="100"> %</td></tr>';
                }
                j++;
            }

            html += '</table>';

            div.innerHTML = html;
            parser.appendChild(div);
        }

        jscolor.init();
    }

    function apply_change(change) {
        if (!css_fields || !change)
            return false;



        var str = content.value.replace(/\n/g, "|"), i, new_str = str,
                ex = /\|?([\.|#]?.*?\{\s?\/\*#(.*?)\*\/\s?\|?(.*?)}\|?)/g, match;

        for (i in change) {
            var data = change[i],
            regexp = replace_regex(data.old);
            if(regexp) {
                css_fields[data.field].values[data.value] = css_fields[data.field].values[data.value].replace(regexp, data.new);
            }
        }
        
        //console.log(css_fields);

        while ((match = ex.exec(str)) !== null) {
            //console.log(match);
            for (i in css_fields) {
                if (css_fields[i].name == match[2]) {
                    // console.log('было: ' + match[0]);
                    var prop = '';
                    for (j in css_fields[i].values) {
                        prop += "\t" + j + ':' + css_fields[i].values[j] + ';|';
                    }
                    match[1] = match[1].replace(match[3], prop);
                    // console.log('стало: ' + match[1]);
                    new_str = new_str.replace(match[0], match[1]);
                    break;
                }
            }
        }
        
        content.value = new_str.replace(/\|/g, "\n");
    }


    $(document).ready(function () {
        create_visual();

        $("#csseditor_parser").on('click', ".transparent", function () {
            $(this).toggleClass("active");
            $(this).parents("tr").find("input").prop('disabled', $(this).hasClass("active"));
        });

        $("#csseditor_parser").parents("form").on('submit', function () {

            var info = [];
            $("#csseditor_parser .csseditor_edit").each(function () {
                var data = {
                    id: $(this).attr('data-id'),
                    old: $(this).attr('data-old'),
                    field: $(this).attr('data-field'),
                    value: $(this).attr('data-value'),
                    opacity: $(this).attr('data-opacity'),
                    new : $(this).val()
                };
                
                var check = /(#[a-f0-9]{3,6})/i;
                if(!check.test(data.new)) {
                    return true; // continue
                }

                var opacity = $("#csseditor_parser .opacity[data-id='" + data.id + "']").val();
                if (opacity < 100) {
                    var rbg = HASH_RBG(data.new);
                    rbg.push((opacity / 100).toFixed(2));
                    data.new = 'rgba(' + rbg.join(', ') + ')';

                }

                if ($("#csseditor_parser .transparent[data-id='" + data.id + "']").hasClass("active")) {
                    data.new = 'transparent';
                }

                if (data.old !== data.new) {
                    info.push(data);
                }
            });

            apply_change(info);
            // return false;
        });
    });

})();