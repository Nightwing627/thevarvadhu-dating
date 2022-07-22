<?php recache();
    $home_searching_heading = $this->db->get_where('frontend_settings', array('type' => 'home_searching_heading'))->row()->value;
?>
<div class="col-lg-3" id="div_properties_search">
    <div class="card card-inverse no-border no-radius" style="min-height: 400px">
        <div class="card-body py-4 px-4">
            <form class="form-inverse mt-4" data-toggle="validator" role="form" action="<?php echo base_url()?>home/listing/home_search" method="POST" style="margin-top: 0px !important;">
                <h3 class="heading heading-5 strong-500 text-capitalize"><?php echo $home_searching_heading?></h3>
                <?php if (!empty($this->session->userdata['member_id'])) { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <select name="gender" onChange="(this.value,this)" class="form-control form-control-sm selectpicker"   data-placeholder="Choose a gender" tabindex="2" data-hide-disabled="true" >
                                    <?php $member_gender = $this->db->get_where('member',array('member_id'=>$this->session->userdata['member_id']))->row()->gender; ?>
                                    <?php if($member_gender == '2') { ?>
                                        <option value="1" >Male</option>
                                    <?php } elseif ($member_gender == '1') { ?>
                                        <option value="2" >Female</option>
                                    <?php } ?>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <label class="text-uppercase"><?php echo translate("i'm_looking_for_a")?></label>
                                <?php echo  $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('aged_from')?></label>
                            <input type="number" class="form-control form-control-sm" name="aged_from" id="aged_from" value="">
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('to')?></label>
                            <input type="number" class="form-control form-control-sm" name="aged_to" id="aged_to" value="">
                        </div>
                        <div class="help-block with-errors">
                        </div>
                    </div>
                </div>
                <?php
                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('religion')?></label>
                            <?php echo  $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker s_religion', '', '', '', ''); ?>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('caste_/_sect')?></label>
                            <select class="form-control form-control-sm selectpicker s_caste" name="caste">
                                <option value=""><?php echo translate('choose_a_religion_first')?></option>
                            </select>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('sub_caste')?></label>
                            <select class="form-control form-control-sm selectpicker s_sub_caste" name="sub_caste">
                                <option value=""><?php echo translate('choose_a_caste_first')?></option>
                            </select>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php
                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('mother_tongue')?></label>
                            <?php echo  $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php
                if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('min_height_(Feet)')?></label>
                            <input type="text" class="form-control form-control-sm height_mask" name="min_height" id="min_height" value="0.00">
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="" class="text-uppercase"><?php echo translate('max_height_(Feet)')?></label>
                            <input type="text" class="form-control form-control-sm height_mask" name="max_height" id="max_height" value="8.00">
                        </div>
                        <div class="help-block with-errors">
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <button type="submit" class="btn btn-styled btn-sm btn-block btn-base-1 mt-4"><?php echo translate('search_now')?></button>
            </form>
        </div>
    </div>
</div>
