<!-- injection du type de cours -->
<?php if($summaryType) : ?>
<script> 
  const summaryType = "<?= $summaryType ?>";
  const descriptionsCourses = <?php echo json_encode($descriptions_courses); ?>;
</script>
<?php endif ?>

<div id="summary_page">

    <h2 id="summary_category"></h2>

    <p id='summary_description'></p>

    <ol>
        <div id='summary_content'>
        </div>
    </ol>

</div>




