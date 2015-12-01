<?php
require_once 'functions.php';
$assignmentId = isset($_GET['assignmentId']) ? $_GET['assignmentId'] : '';
$workerId = isset($_GET['workerId']) ? $_GET['workerId'] : '';
$lang = isset($_GET['lang']) ? strtolower($_GET['lang']) : 'en';
$pdf = isset($_GET['pdf']) ? $_GET['pdf'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resource Contracts - MTurk Task</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">    
    <script src="jquery.js"></script>
    <script type="text/javascript">
     $(function () {

        $('#mturk_form').on('submit', function(e){
            if($('#feedback').val() == '')
            {
                e.preventDefault();
                alert('Text can\'t be empty.');            
            }            
        });
        
    })
    </script>
</head>
<body>
    <div class="wrapper">
        <p>In this HIT, you are to transcribe the text <?php echo show_language($lang);?> as shown in the scanned pdf on the right. It is possible that your HIT will be rejected if we find that there are number of spelling mistakes or missing text in the transcribed text.</p>
    
        <?php if($assignmentId == 'ASSIGNMENT_ID_NOT_AVAILABLE'):?>
            <p class="disclaimer"><?php echo disclaimer($lang);?></p>
            <div id="instructions">
                    <?php echo other_instructions($lang);?>
            </div>
        <?php else:?>
            <p class="disclaimer"><?php echo disclaimer($lang);?></p>
            <p><a href="#instructions" class="see_other_instruction">See other instructions</a></p>
        <?php endif;?>

        <div class="left">
            <form id="mturk_form" method="post" accept-charset="utf-8" action="https://www.mturk.com/mturk/externalSubmit">
                <input type="hidden" name="workerId" value="<?php echo $workerId;?>"/>
                <input type="hidden" name="assignmentId" value="<?php echo $assignmentId;?>"/>
                <textarea name="feedback" id="feedback" style="width: 100%" rows="38.5" placeholder="Write the text here"></textarea>
                <br/>

            <?php if($assignmentId != 'ASSIGNMENT_ID_NOT_AVAILABLE'):?>
                <button type="submit" value="Submit" class="button">Finish and Submit HIT</button>
            <?php else:?>
                <p>You must accept HIT before you can submit the result.</p>
            <?php endif;?>
    
            </form>
        </div>
        <div class="right">
           <iframe width="100%" height="590" src="/viewer#<?php echo $pdf;?>"></iframe>
        </div>
    </div>

    <?php if($assignmentId != 'ASSIGNMENT_ID_NOT_AVAILABLE'):?>
        <div id="instructions" class="wrapper">
             <?php echo other_instructions($lang);?>
        </div>
    <?php endif;?>
</body>
</html>