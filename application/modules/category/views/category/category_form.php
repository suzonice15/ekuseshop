<div class="form-group ">
    <label for="category_title">Category Name<span class="required">*</span></label>
    <input required type="text" id="category_title" class="form-control the_title" name="category_title" value="">
</div>
<div class="form-group "><label for="category_name">Parmalink<span class="required">*</span></label>
    <input required type="text" class="form-control the_name" id="category_name" name="category_name" value="">
    <span id="categoryError" style="text-danger"></span>
</div>
<div class="form-group "><label for="parent_id">Select Parent</label>
    <select class="form-control select2 " name="parent_id">
        <option value="0">--- choose ---</option>
        <?php if (isset($categories)): foreach ($categories as $category): ?>
            <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_title; ?></option>
        <?php endforeach;endif; ?>
    </select>

</div>

<div  hidden class="form-group featured-image"><label>Category Icon <span class="required">(Size 30 * 30)</span></label> <input
        type="file" class="form-control"
        name="featured_image">

</div>

<div class="form-group medium-banner"><label>Banner Image <span class="required">Size(318 * 624)</span></label> <input
        type="file" class="form-control"
        name="medium_banner">

</div>
<div hidden class="form-group featured-image"><label>Category Gallery1</label> <input type="file" class="form-control"
                                                                                      name="category_gallery1">

</div>

<div hidden class="form-group featured-image"><label>Category Gallery2</label> <input type="file" class="form-control"
                                                                                      name="category_gallery2">
</div>
<div hidden class="form-group featured-image"><label>Category Gallery3</label> <input type="file" class="form-control"
                                                                                      name="category_gallery3">
</div>
<div hidden class="form-group "><label for="target_url1">Gallery Target URL 01</label> <input type="text"
                                                                                              class="form-control"
                                                                                              name="target_url1"
                                                                                              value="">
</div>
<div hidden class="form-group "><label for="target_url2">Gallery Target URL 02</label> <input type="text"
                                                                                              class="form-control"
                                                                                              name="target_url2"
                                                                                              value="">
</div>
<div hidden class="form-group "><label for="target_url3">Gallery Target URL 03</label> <input type="text"
                                                                                              class="form-control"
                                                                                              name="target_url3"
                                                                                              value="">
</div>
<div class="form-group "><label for="rank_order">Rank Order</label> <input type="text" class="form-control"
                                                                           name="rank_order" value="">
</div>
<div class="form-group">
    <label for="billing_name">Published Status<span class="text-danger">*</span></label>
    <select  name="status" id="payment_type" class="form-control">
        <option value="1">Published</option>
        <option value="0">Unpublished </option>
    </select>
</div>
<div hidden class="form-group medium-banner">
    <div class="checkbox"><label><input type="checkbox" name="top_menu" value="1">Checked as Top Menu</label></div>
</div>

<div class="box box-primary" style="border: 2px solid #ddd;">
    <div class="box-header" style="background-color: #bdbdbf;">
        <h3 class="box-title">SEO Options</h3>
    </div>

    <div class="box-body">

        <div class="form-group ">
            <label for="seo_title"> Title</label> <input type="text" class="form-control" name="seo_title"
                                                         id="seo_title" value=""></div>
        <div hidden class="form-group "><label for="seo_meta_title">SEO Meta Title</label> <input type="text"
                                                                                                  class="form-control"
                                                                                                  name="seo_meta_title"
                                                                                                  id="seo_meta_title"
                                                                                                  value="">
        </div>

        <div class="form-group "><label for="seo_meta_content"> Meta Description</label> <textarea class="form-control"
                                                                                                   rows="2"
                                                                                                   name="seo_meta_content"
                                                                                                   id="seo_meta_content"></textarea>
        </div>
        <div class="form-group "><label for="seo_keywords">Meta Keywords</label> <input type="text" class="form-control"
                                                                                        name="seo_keywords"
                                                                                        id="seo_keywords" value="">
        </div>
        <div class="form-group "><label for="seo_content"> Content</label> <textarea id="editor1" class="form-control"
                                                                                     rows="5"
                                                                                     name="seo_content"
                                                                                     id="seo_content"></textarea>
        </div>

    </div>
</div>



