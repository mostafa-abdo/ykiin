<?php

namespace App\WidgetsBuilder\Widgets;
use App\Language;
use App\WidgetsBuilder\WidgetBase;

class ContactInfoWidget extends WidgetBase
{

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

            $widget_title = $widget_saved_values['widget_title'] ?? '';
            $location =  $widget_saved_values['location'] ?? '';
            $phone =  $widget_saved_values['phone'] ?? '';
            $email =  $widget_saved_values['email'] ?? '';

            $output .= '<div class="form-group"><input type="text" name="widget_title"  class="form-control" placeholder="' . __('Widget Title') . '" value="'. $widget_title .'"></div>';
            $output .= '<div class="form-group"><input type="text" name="location" class="form-control" placeholder="' . __('Location') . '" value="'. $location .'"></div>';
            $output .= '<div class="form-group"><input type="text" name="phone"  class="form-control" placeholder="' . __('Phone') . '" value="'. $phone .'"></div>';
            $output .= '<div class="form-group"><input type="email" name="email" class="form-control" placeholder="' . __('Email') . '" value="'. $email .'"></div>';


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        // TODO: Implement frontend_render() method.
        $home_page = get_static_option('home_page_variant');
        $widget_saved_values = $this->get_settings();
        $widget_title =  $widget_saved_values['widget_title'] ?? '';
        $location =  $widget_saved_values['location'] ?? '';
        $phone =  $widget_saved_values['phone'] ?? '';
        $email = $widget_saved_values['email'] ?? '';


        

        if(!empty($home_page) && $home_page == '00'){
            $output = '<div class="col-md-4 col-12 d-flex flex-column align-items-center">'; //render widget before content;
            $output .= '<div class="text-start">';
            if (!empty($widget_title)){
                $output .= '<h5 class="text-white mb-5 text-md-start text-center">'.purify_html($widget_title).'</h5>';
            }
            $output .= '<ul class="contact-info list-unstyled text-white fs-5">';
            if(!empty($phone)){
                $output .= '<li>
                        <span>
                            <i class="fa-solid fa-phone fs-5 text-secondary mx-2"></i>
                        </span>

                        <span>
                            '.purify_html($phone).'
                        </span>

                    </li>';
            }
        
            if(!empty($email)){
                $output .= '<li>
                        <span>
                            <i class="fa-solid fa-envelope fs-5 text-secondary mx-2"></i>
                        </span>

                        <span>
                            '.purify_html($email).'
                        </span>

                    </li>';
            }
            if(!empty($location)){
                $output .= '<li>
                        <span>
                            <i class="fa-solid fa-location-dot fs-5 text-secondary mx-2"></i>
                        </span>
                        <span>
                            '.purify_html($location).'
                        </span>

                    </li>';
            }

            $output .= '</ul>';

            $output .= '</div>';
            $output .= '</div>';
        }else{
            $output = $this->widget_before(); //render widget before content
            if (!empty($widget_title)){
                $output .= '<h4 class="widget-title">'.purify_html($widget_title).'</h4>';
            }
            $output .= '<ul class="contact_info_list">';
            if(!empty($phone)){
                $output .= '<li class="single-info-item">
                        <div class="icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="details">
                        '.purify_html($phone).'
                        </div>
                    </li>';
            }
        
            if(!empty($email)){
                $output .= '<li class="single-info-item">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="details">
                        '.purify_html($email).'
                        </div>
                    </li>';
            }
            if(!empty($location)){
                $output .= ' <li class="single-info-item">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="details">
                            '.purify_html($location).'
                        </div>
                    </li>';
            }

            $output .= '</ul>';
            $output .= $this->widget_after(); // render widget after content
        }

        return $output;
    }

    public function widget_title()
    {
        return __('Contact Info');
    }

}