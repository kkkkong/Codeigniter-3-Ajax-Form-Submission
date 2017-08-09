<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Form</title>
    <style>
        html, body {
            background-color: #ccc;
        }
        input {
            width: 300px;
        }
        div.container {
            background-color: #fff;
            border-radius: 2px;
            margin: auto auto;
            width: 50%;
            padding: 20px;
            text-align: center;
        }
        div.errors {
            padding: 10px;
            color: red;
            background-color: #ddd;
            border: 1px solid #ccc;
        }
        div.success {
            padding: 22px;
            color: green;
            background-color: #ddd;
            border: 1px solid #ccc;
        }

        /* Start by setting display:none to make this hidden.
       Then we position it in relation to the viewport window
       with position:fixed. Width, height, top and left speak
       speak for themselves. Background we set to 80% white with
       our animation centered, and no-repeating */
        .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('http://sampsonresume.com/labs/pIkfp.gif')
            50% 50%
            no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="jsError"></div>

        <h3>Please give us a valid website URL</h3>
        <?php echo form_open('Website/submission', array('class'=>'jsform')); ?>
<!--        <p><input type="text" name="website"></p>-->
<!--        <p><input type="text" name="neme"></p>-->
        <h5>Username</h5>
        <?php echo form_error('username'); ?>
        <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" size="50" />

        <h5>Password</h5>
        <?php echo form_error('password'); ?>
        <input type="text" id="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />

        <h5>Password Confirm</h5>
        <?php echo form_error('passconf'); ?>
        <input type="text" id="passconf" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />

        <h5>Email Address</h5>
        <?php echo form_error('email'); ?>
        <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

        <p><input type="submit" value="Check Website"></p>
        <?php echo form_close(); ?>
    </div>
    <div class="modal"></div>

</body>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script src="<?php echo base_url() ?>public/lib/js/jquery-1.10.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $body = $("body");

        $(document).on('submit','form', function (event) {
            $body.addClass("loading");
            event.preventDefault();

            var url = $(this).attr("action");

            $.ajax({
                url: url,
                type: $(this).attr("method"),
                enctype: 'multipart/form-data',
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status)
                {
                    $('div.jsError').html(data.err);
                },
                error: function (xhr, desc, err)
                {


                }
            })
                .done(function (data) {
                    if(data.flag){
                        $( 'form.jsform' ).each(function(){
                            this.reset();
                        });
                    }

                    $body.removeClass("loading");
                });

        })

    });
</script>

</html>
