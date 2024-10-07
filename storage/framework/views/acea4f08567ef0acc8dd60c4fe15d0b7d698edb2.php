<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="\css\style.css">
</head>
<body>
<h1>нгысов</h1>
<div id="leftNavbar">

</div>
<?php if(auth()->guard()->guest()): ?>

<?php endif; ?>
<?php if(auth()->guard()->check()): ?>

<?php endif; ?>


</body>
</html><?php /**PATH C:\OSPanel\domains\project-manager\back\resources\views/layouts/left-navbar.blade.php ENDPATH**/ ?>