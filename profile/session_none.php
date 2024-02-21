<input type="text" name="header_title" placeholder="SAMPLE SAMPLE" style="display: none;" value="<?= getSessionValue("header_titleValue"); ?>">
<select name="header_h1" id="1" style="display: none;">
    <option value="h1" selected>h1</option>
    <option value="h2">h2</option>
    <option value="h3">h3</option>
    <option value="h4">h4</option>
    <option value="h5">h5</option>
    <option value="h6">h6</option>
</select>
<!-- 他の input タグも同様に修正 -->

<div class="accordion_header">
    <label class="form_item">
        <input class="input_one" name="greeting_title_color" type="color" placeholder="10" style="display: none;" value="<?= getSessionValue("greeting_title_colorValue"); ?>">
    </label>
</div>
<div class="accordion_header">
    <label class="form_item">
        <input class="input_one" name="greeting_fontsize" type="text" placeholder="10" style="display: none;" value="<?= getSessionValue("greeting_fontsizeValue"); ?>">
    </label>
</div>

<div class="accordion_header">
    <label class="form_item">
        <input class="input_one" type="color" name="menu_title1_color" placeholder="200" style="display: none;" value="<?= getSessionValue("menu_title1_colorValue"); ?>">
    </label>
</div>
<div class="accordion_header">
    <label class="form_item">
        <input class="input_one" type="color" name="menu_title2_color" placeholder="200" style="display: none;" value="<?= getSessionValue("menu_title2_colorValue"); ?>">
    </label>
</div>
<!-- 他の input タグも同様に修正 -->
