<?php

use \Etn\Utils\Helper;

defined( 'ABSPATH' ) || exit;

$event_options  = get_option("etn_event_options");
$data           = Helper::single_template_options( $single_event_id );

$harry_event_button_text = get_theme_mod( 'harry_event_button_text', __( 'Make an Appointment', 'harry' ) );
$harry_event_button_url = get_theme_mod( 'harry_event_button_url', __( '#', 'harry' ) );

?>

    <div class="event__sidebar mt-5 ml-50">
        <div class="event__widget mb-40">
            <h3 class="event__widget-title"><?php echo esc_html__('About Speaker: ', 'harry'); ?></h3>
            <div class="event__widget-content">
                <?php 
                    $etn_event_schedule = get_post_meta( $single_event_id, 'etn_event_schedule', true);
                    if ($etn_event_schedule != '') :  
                        $etn_schedule_topics = get_post_meta($etn_event_schedule[0], 'etn_schedule_topics', true);
                        $etn_schedule_speakers_ids = $etn_schedule_topics[0]['etn_shedule_speaker'];

                    foreach($etn_schedule_speakers_ids as $speaker): 
                        $speaker_name = get_post_meta($speaker, 'etn_speaker_title', true);
                        $etn_speaker_designation = get_post_meta($speaker, 'etn_speaker_designation', true);
                        $speaker_avatar = get_the_post_thumbnail_url( $speaker, 'thumbnail' );
                        $speaker_url = get_the_permalink($speaker); 
                        
                ?>
                <div class="event__speaker-item d-flex">
                    <?php if(!empty($speaker_avatar)) :  ?>
                    <div class="event__speaker-thumb w-img">
                        <img src="<?php echo esc_url($speaker_avatar); ?>" alt="<?php echo esc_attr($speaker_name); ?>">
                    </div>
                    <?php endif; ?>

                    <div class="event__speaker-content">
                        <h3 class="event__speaker-title">
                            <a href="<?php echo esc_url($speaker_url); ?>"><?php echo esc_html($speaker_name); ?></a>
                        </h3>
                        <?php if(!empty($etn_speaker_designation)) : ?>
                        <span class="event__speaker-designation"><?php echo esc_html($etn_speaker_designation); ?></span>
                        <?php endif; ?>
                    </div>

                </div>
                <?php endforeach; endif; ?>

            </div>
        </div>
        <div class="event__widget mb-20">
            <h3 class="event__widget-title"><?php echo esc_html__('Event Info', 'harry') ?></h3>
            <div class="event__widget-content">
                <div class="event__details-info">
                    <?php if(!isset($event_options["etn_hide_date_from_details"])): 
                        $separate = !empty($data['event_end_date']) ? ' - ' : '';
                    ?>
                    <div class="event__details-info-item d-flex align-items-start">
                        <div class="event__details-info-icon">
                            <span>
                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.55554 1V4.33333" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.4446 1V4.33333" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.55573 8.8777H20.4446" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21 8.2222V17.6666C21 21 19.3333 23.2222 15.4444 23.2222H6.55556C2.66667 23.2222 1 21 1 17.6666V8.2222C1 4.88886 2.66667 2.66664 6.55556 2.66664H15.4444C19.3333 2.66664 21 4.88886 21 8.2222Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.1051 14H15.115" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.1051 17.3332H15.115" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.995 14H11.005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.995 17.3332H11.005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.88258 14H6.89256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.88258 17.3332H6.89256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                         
                            </span>
                        </div>
                        <div class="event__details-info-content">
                            <h4 class="event__details-info-title"><?php echo esc_html__('Date', 'harry'); ?></h4>
                            <p><?php echo esc_html($data['event_start_date']); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                        if( !class_exists('Wpeventin_Pro') || get_post_meta($single_event_id, 'etn_event_location_type', true) != 'new_location' ) :
                                if ( !isset($event_options["etn_hide_location_from_details"]) && !empty($data['etn_event_location'])) ;
                    ?>
                    <div class="event__details-info-item d-flex align-items-start">
                        <div class="event__details-info-icon">
                            <span>
                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.99967 12.4329C11.7982 12.4329 13.2562 11.0357 13.2562 9.31213C13.2562 7.58857 11.7982 6.19135 9.99967 6.19135C8.20115 6.19135 6.74316 7.58857 6.74316 9.31213C6.74316 11.0357 8.20115 12.4329 9.99967 12.4329Z" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M1.25338 7.49162C3.30957 -1.17054 16.7009 -1.16054 18.7467 7.50163C19.947 12.5829 16.6487 16.884 13.7575 19.5446C11.6596 21.4851 8.34045 21.4851 6.23207 19.5446C3.35132 16.884 0.0530624 12.5729 1.25338 7.49162Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>                                                                                                                                                                
                            </span>
                        </div>
                        <div class="event__details-info-content">
                            <h4 class="event__details-info-title"><?php echo esc_html__('Venue: ', 'harry'); ?></h4>
                            <p><?php echo esc_html($data['etn_event_location']);  ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php 
                    if ( !isset($event_options["etn_hide_time_from_details"]) && ( !empty( $data['event_start_time'] ) || !empty( $data['event_end_time'] ) )) :
                        $separate = !empty($data['event_end_time']) ? ' - ' : '';
                    ?>
                    <div class="event__details-info-item d-flex align-items-start">
                        <div class="event__details-info-icon">
                            <span>
                                <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 21.5C16.5228 21.5 21 17.0228 21 11.5C21 5.97715 16.5228 1.5 11 1.5C5.47715 1.5 1 5.97715 1 11.5C1 17.0228 5.47715 21.5 11 21.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 5.5V11.5L15 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                   
                            </span>
                        </div>
                        <div class="event__details-info-content">
                            <h4 class="event__details-info-title"><?php echo esc_html__('Time', 'harry'); ?></h4>
                            <p><?php echo esc_html($data['event_start_time'] . $separate . $data['event_end_time']); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                <?php if(!empty($data['etn_deadline_value'])): ?>
                    <div class="event__details-info-item d-flex align-items-start">
                        <div class="event__details-info-icon">
                            <span>
                                <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.69995 1.66663H4.29995C1.16662 1.66663 0.92495 4.48329 2.61662 6.01663L11.3833 13.9833C13.075 15.5166 12.8333 18.3333 9.69995 18.3333H4.29995C1.16662 18.3333 0.92495 15.5166 2.61662 13.9833L11.3833 6.01663C13.075 4.48329 12.8333 1.66663 9.69995 1.66663Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                                                                                              
                            </span>
                        </div>
                        <div class="event__details-info-content">
                            <h4 class="event__details-info-title"><?php echo esc_html__('Reg. Deadline: ', 'harry'); ?></h4>
                            <p><?php echo esc_html($data['etn_deadline_value']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(!empty($harry_event_button_url)) : ?>
        <div class="event__widget">
            <div class="event__details-btn">
                <a href="<?php echo esc_url($harry_event_button_url); ?>" class="tp-btn w-100"><?php echo esc_html($harry_event_button_text); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <?php do_action("etn_after_single_event_meta", $single_event_id); ?>
    </div> <!-- end wrapper -->