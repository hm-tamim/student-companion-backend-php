<?php

if (preg_match('(login|user|sign|profile)', $_SERVER[REQUEST_URI]) === 0) {

    ?>
    <a class="openapp" style="color: white" data-applink="market://details?id=club.nsuer.nsuer"
       href="https://play.google.com/store/apps/details?id=club.nsuer.nsuer" rel="alternate">

        <div class="ad" style="margin-bottom: 8px;
    color: #fff;
    background-color: #4196af; height: 300px; padding: 10px 15px; overflow: hidden; border-radius: 3px;">

            <table style="background: #4196af; font-weight: normal" border="0">
                <tr style="vertical-align: top;">
                    <td style="border: 0px; font-weight: normal; padding-top: 20px">

                        NSUer App is published now.

                        <br><br><br>

                        Get it from <a class="openapp" style="color: #ebff9b; font-weight: bold"
                                       data-applink="market://details?id=club.nsuer.nsuer"
                                       href="https://play.google.com/store/apps/details?id=club.nsuer.nsuer"
                                       rel="alternate"> Google Play Store</a>.

                        <br><br><br>

                        It has all the features of NSUer.Club, even much better and faster.
                    </td>
                    <td>
                        <img style="    display: block;
    max-height: 285px;
    float: right;
    margin-top: -10px;
    margin-right: 0px;" src="/images/nsuer-app-ui.jpg">
                    </td>
                </tr>
            </table>

    </a>


    </div>

    <script>
        ;(function ($, window, document, undefined) {
            var pluginName = 'applink',
                mobile = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent),
                defaults = {
                    popup: true,
                    desktop: false,
                    delegate: null,
                    data: pluginName
                };

            var Callback = function ($element, settings) {
                var href = $element.attr('href'),
                    applink = $element.data(settings.data),
                    enabled = (mobile || settings.desktop) ? applink : false;

                enabled = (enabled && (typeof enabled !== 'undefined')) ? true : false;

                if (!enabled) {
                    return Link(href, settings);
                }

                window.location = applink;

                var time = +new Date;

                setTimeout(function () {
                    if ((+new Date - time) < 400) {
                        Link(href, settings);
                    }
                }, 300);
            }

            var Link = function (href, settings) {
                if (settings.popup && /^https?:\/\/(www\.)?(facebook|twitter)\.com/i.test(href)) {
                    PopUp(href);
                } else {
                    window.location = href;
                }
            }

            var PopUp = function (href) {
                var width = (screen.width > 620) ? 600 : screen.width,
                    height = (screen.height > 300) ? 280 : screen.height,
                    left = (screen.width / 2) - (width / 2),
                    top = (screen.height / 2) - (height / 2),
                    options = 'location=no,menubar=no,status=no,toolbar=no,scrollbars=no,directories=no,copyhistory=no'
                        + ',width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;

                window.open(href, pluginName, options).focus();
            }

            var Plugin = function (element, options) {
                this.element = element;

                this.settings = $.extend({}, defaults, options);

                this.init();
            }

            Plugin.prototype = {
                init: function () {
                    var $element = $(this.element), that = this;

                    $element.on('click.' + pluginName, this.settings.delegate, function (event) {
                        event.preventDefault();
                        Callback($(this), that.settings);
                    });
                },

                destroy: function () {
                    $(this.element).off('.' + pluginName);
                }
            };

            $.fn[pluginName] = function (options) {
                if ((options === undefined) || (typeof options === 'object')) {
                    return this.each(function () {
                        if (!$.data(this, 'plugin_' + pluginName)) {
                            $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                        }
                    });
                }

                if ((typeof options !== 'string') || (options[0] === '_') || (options === 'init')) {
                    return true;
                }

                var returns, args = arguments;

                this.each(function () {
                    var instance = $.data(this, 'plugin_' + pluginName);

                    if ((instance instanceof Plugin) && (typeof instance[options] === 'function')) {
                        returns = instance[options].apply(instance, Array.prototype.slice.call(args, 1));
                    }

                    if (options === 'destroy') {
                        $.data(this, 'plugin_' + pluginName, null);
                    }
                });

                return (returns !== undefined) ? returns : this;
            };
        })(jQuery, window, document);
    </script>


    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('a[data-applink]').applink();

        });
    </script>


    <?php


}


if ($islogged == 1) {

    echo '<div class="addcontainer bar1 shadow flist"><h2>RECENTLY UPLOADED</h2>';


    $dir = $_SERVER['DOCUMENT_ROOT'] . '/files/' . strtolower($_SESSION['email']) . '/';

    $dir2 = '/files/' . strtolower($_SESSION['email']) . '/';

    function scan_dir($dir)
    {
        $ignored = array('.', '..', '.svn', '.htaccess');

        $files = array();
        foreach (scandir($dir) as $file) {
            if (in_array($file, $ignored)) continue;
            $files[$file] = filemtime($dir . '/' . $file);
        }

        arsort($files);
        $files = array_keys($files);

        return ($files) ? $files : false;
    }


    $ffs = scan_dir($dir);

    ksort($ffs);
    echo '<ul>';

    $p = 0;
    $t = 0;

    $x = 0;
    foreach ($ffs as $ff) {
        $x++;

        if ($x == 10) {
            if ($thisPage != "file")
                break;
        }

        if ($ff != '.' && $ff != '..') {
            echo '<li id="p' . $p . '">';


            if (is_dir($dir . '/' . $ff)) {
                echo $ff;
                listFolderFiles($dir . '/' . $ff);
            } else {

                $ffff = ucfirst(str_replace('-', ' ', $ff));

                echo "<a href='$dir2$ff' download><b class=\"fttl\">$ffff</b></a> <br><div class='fileInfo'>Size: <b>" . formatBytes(filesize($dir . '/' . $ff)) . "</b> - " . date('F d, Y', filectime($dir . '/' . $ff));

                $path_info = pathinfo($ff);
                $ext = $path_info['extension'];
                $allowed = array('txt', 'java', 'c', 'sql');


                if (in_array(strtolower($ext), $allowed)) {

                    $loc = $_SERVER['DOCUMENT_ROOT'] . '/files/' . strtolower($uEmail) . '/';

                    $fileLocation = $dir . '/' . $ff;


                    $filez = file_get_contents($fileLocation);


                    echo "<textarea id='$t' class='txtview' readonly>$filez</textarea>";
                }

                echo '
<div class="actionbtn">
<form action="" method="post">
<input type="hidden" name="editText" value="' . $ff . '">

<button type="submit" class="edt" ';


                if (!in_array(strtolower($ext), $allowed))
                    echo "disabled";


                echo '>Edit</button> ';


                echo ' <a class="dlt" onclick="deleteFile(this,\'p' . $p . '\');return false" href="/upload/delete.php?filen=' . $ff . '">Delete</a> ';

                if (in_array(strtolower($ext), $allowed))
                    echo '<button class="edt cpy" onclick="copyt(this,\'' . $t . '\'); return false;">COPY</button>';

                echo '</form>

</div>
</div>';


            }
            $p++;
            $t++;
            echo '</li>';
        }
    }


    echo '</ul>
</div>
';

}

?>
<?php if ($islogged != 1) { ?>
    <div class="addcontainer bar1 shadow"><h2>Login</h2>
        <p class="cfade">Don't have account? <a href='/sign-up'>Sign up</a></p><br/>
        <form action="/user/login.php" method="POST">
            <input type="hidden" name="ref" value="<?php echo $reff; ?>">
            <input type="text" name="email" value="" placeholder="Enter Email"><br/>
            <input type="password" name="password" value="" placeholder="Enter Password"><br/>
            <input type="submit" name="submit" value="Login"></form>
    </div>
<?php } ?>

<!--
<div class="addcontainer bar1 shadow"><h2>Add Course</h2><p class="cfade">You can add multiple faculties by separating with comma (Example: SBS,ADF,NBM). Please don't add bad words.</p><br/><form action="/addcourse.php" method="POST"><input type="text" name="course" value="" placeholder="Enter course initial"><br/><input type="text" name="faculty" value="" placeholder="Enter faculty initial"><br/>
<input type="submit" name="submit" value="ADD COURSE"></form></div>
-->

<div id="newupdates" class="addcontainer bar1 shadow"><h2>New Updates</h2>
    <ul>
        <li>All the advising tools are updated for <b>Summer 2020</b></li>

        <li>You can search multiple courses by separating with a comma.
            <p class="pdd"><b>Example:</b> ECO201,PHB101,BUS173</p></li>

        <li>New shortcut link feature added to get multiple or single course's faculties more easily.
            <p class="pdd"><b>http://nsuer.club/eng103,mat120</b></p></li>


        <li>A input box added on the bottom for sharing link of that page. Just click on the <b>COPY</b> button and
            paste anywhere you want, such as facebook post comments.
        </li>

        <li>Add multiple faculties to a course by separating with a comma.
            <p class="pdd"><b>Example:</b> SBS,ADF,MLE</p></li>
    </ul>
</div>
<style>
    ul {
        padding-left: 15px;
        list-style: square outside none;
    }

    .addcontainer li {
        color: #232323;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 15px;
        background: #f9f1f1;
        border-radius: 5px;
        padding-left: 15px;
        margin-bottom: 6px;
        margin-top: 8px;
        padding-right: 15px;
    }

    .pdd {
        margin-top: 10px;
        margin-bottom: 0px;

    }
</style>