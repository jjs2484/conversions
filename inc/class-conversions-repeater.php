<?php
/**
 * Repeater functionality for the customizer
 *
 * @package conversions
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}
/**
 * Class Conversions_Repeater
 */
class Conversions_Repeater extends \WP_Customize_Control {

	/**
	 * ID of the field
	 *
	 * @var string
	 */
	public $id;

	/**
	 * Repeater box title
	 *
	 * @var array
	 */
	private $boxtitle = array();

	/**
	 * Repeater Add field button label
	 *
	 * @var array
	 */
	private $add_field_label = array();

	/**
	 * Repeater Icon container
	 *
	 * @var string
	 */
	private $customizer_icon_container = '';

	/**
	 * Repeater Allowed HTML tags
	 *
	 * @var array
	 */
	private $allowed_html = array();

	/**
	 * Check if image control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_image_control = false;

	/**
	 * Check if icon control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_icon_control = false;

	/**
	 * Check if color control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_color_control = false;

	/**
	 * Check if title control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_title_control = false;

	/**
	 * Check if subtitle control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_subtitle_control = false;

	/**
	 * Check if second subtitle control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_subtitle2_control = false;

	/**
	 * Check if text control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_text_control = false;

	/**
	 * Check if link text control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_linktext_control = false;

	/**
	 * Check if link control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_link_control = false;

	/**
	 * Check if the social repeater control is added in the repeater
	 *
	 * @var bool
	 */
	public $customizer_repeater_repeater_control = false;

	/**
	 * Class constructor.
	 *
	 * @param string $manager Value.
	 * @param string $id ID.
	 * @param string $args Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		// Get options from customizer.php.
		$this->add_field_label = esc_html__( 'Add new field', 'conversions' );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}
		$this->boxtitle = esc_html__( 'Customizer Repeater', 'conversions' );
		if ( ! empty( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}
		if ( ! empty( $args['customizer_repeater_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['customizer_repeater_image_control'];
		}
		if ( ! empty( $args['customizer_repeater_icon_control'] ) ) {
			$this->customizer_repeater_icon_control = $args['customizer_repeater_icon_control'];
		}
		if ( ! empty( $args['customizer_repeater_color_control'] ) ) {
			$this->customizer_repeater_color_control = $args['customizer_repeater_color_control'];
		}
		if ( ! empty( $args['customizer_repeater_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
		}
		if ( ! empty( $args['customizer_repeater_subtitle_control'] ) ) {
			$this->customizer_repeater_subtitle_control = $args['customizer_repeater_subtitle_control'];
		}
		if ( ! empty( $args['customizer_repeater_subtitle2_control'] ) ) {
			$this->customizer_repeater_subtitle2_control = $args['customizer_repeater_subtitle2_control'];
		}
		if ( ! empty( $args['customizer_repeater_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['customizer_repeater_text_control'];
		}
		if ( ! empty( $args['customizer_repeater_linktext_control'] ) ) {
			$this->customizer_repeater_linktext_control = $args['customizer_repeater_linktext_control'];
		}
		if ( ! empty( $args['customizer_repeater_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['customizer_repeater_link_control'];
		}
		if ( ! empty( $args['customizer_repeater_repeater_control'] ) ) {
			$this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
		}
		if ( ! empty( $id ) ) {
			$this->id = $id;
		}
		if ( file_exists( get_template_directory() . '/inc/customizer-icons.php' ) ) {
			$this->customizer_icon_container = '/inc/customizer-icons';
		}
		$allowed_array1     = wp_kses_allowed_html( 'post' );
		$allowed_array2     = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array(),
			),
		);
		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	/**
	 * Render the control
	 */
	public function render_content() {
		// Get default options.
		$this_default = json_decode( $this->setting->default );
		// Get values (json format).
		$values = $this->value();
		// Decode values.
		$json = json_decode( $values );
		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default );
					?>
					<input type="hidden"
						id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-collector" <?php esc_attr( $this->link() ); ?>
						class="customizer-repeater-collector"
						value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array();
					?>
					<input type="hidden"
						id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-collector" <?php esc_attr( $this->link() ); ?>
						class="customizer-repeater-collector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json );
				?>
				<input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-collector" <?php esc_attr( $this->link() ); ?>
					class="customizer-repeater-collector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			}
			?>
		</div>
		<button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
		</button>
		<?php
	}

	/**
	 * Iterate array
	 *
	 * @param array $array Array to iterate.
	 */
	private function iterate_array( $array = array() ) {
		// Counter checks if the box is first and should have the delete button disabled.
		$it = 0;
		if ( ! empty( $array ) ) {
			foreach ( $array as $icon ) {
				?>
				<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ); ?>
					</div>
					<div class="customizer-repeater-box-content-hidden">
						<?php
						$choice     = '';
						$image_url  = '';
						$icon_value = '';
						$title      = '';
						$subtitle   = '';
						$subtitle2  = '';
						$text       = '';
						$linktext   = '';
						$link       = '';
						$repeater   = '';
						$color      = '';

						if ( ! empty( $icon->id ) ) {
							$id = $icon->id;
						}
						if ( ! empty( $icon->choice ) ) {
							$choice = $icon->choice;
						}
						if ( ! empty( $icon->image_url ) ) {
							$image_url = $icon->image_url;
						}
						if ( ! empty( $icon->icon_value ) ) {
							$icon_value = $icon->icon_value;
						}
						if ( ! empty( $icon->color ) ) {
							$color = $icon->color;
						}
						if ( ! empty( $icon->title ) ) {
							$title = $icon->title;
						}
						if ( ! empty( $icon->subtitle ) ) {
							$subtitle = $icon->subtitle;
						}
						if ( ! empty( $icon->subtitle2 ) ) {
							$subtitle2 = $icon->subtitle2;
						}
						if ( ! empty( $icon->text ) ) {
							$text = $icon->text;
						}
						if ( ! empty( $icon->linktext ) ) {
							$linktext = $icon->linktext;
						}
						if ( ! empty( $icon->link ) ) {
							$link = $icon->link;
						}
						if ( ! empty( $icon->feature_repeater ) ) {
							$repeater = $icon->feature_repeater;
						}
						if ( true == $this->customizer_repeater_image_control && true == $this->customizer_repeater_icon_control ) {
							$this->icon_type_choice( $choice );
						}
						if ( true == $this->customizer_repeater_image_control ) {
							$this->image_control( $image_url, $choice );
						}
						if ( true == $this->customizer_repeater_icon_control ) {
							$this->icon_picker_control( $icon_value, $choice );
						}
						if ( true == $this->customizer_repeater_color_control ) {
							$this->input_control(
								array(
									'label'             => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Color', 'conversions' ), $this->id, 'customizer_repeater_color_control' ),
									'class'             => 'customizer-repeater-color-control',
									'type'              => apply_filters( 'conversions_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
									'sanitize_callback' => 'sanitize_hex_color',
									'choice'            => $choice,
								),
								$color
							);
						}
						if ( true == $this->customizer_repeater_title_control ) {
							$this->input_control(
								array(
									'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Title', 'conversions' ), $this->id, 'customizer_repeater_title_control' ),
									'class' => 'customizer-repeater-title-control',
									'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
								),
								$title
							);
						}
						if ( true == $this->customizer_repeater_subtitle_control ) {
							$this->input_control(
								array(
									'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Subtitle', 'conversions' ), $this->id, 'customizer_repeater_subtitle_control' ),
									'class' => 'customizer-repeater-subtitle-control',
									'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
								),
								$subtitle
							);
						}
						if ( true == $this->customizer_repeater_subtitle2_control ) {
							$this->input_control(
								array(
									'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Subtitle', 'conversions' ), $this->id, 'customizer_repeater_subtitle2_control' ),
									'class' => 'customizer-repeater-subtitle2-control',
									'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle2_control' ),
								),
								$subtitle2
							);
						}
						if ( true == $this->customizer_repeater_text_control ) {
							$this->input_control(
								array(
									'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Text', 'conversions' ), $this->id, 'customizer_repeater_text_control' ),
									'class' => 'customizer-repeater-text-control',
									'type'  => apply_filters( 'conversions_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
								),
								$text
							);
						}
						if ( true == $this->customizer_repeater_linktext_control ) {
							$this->input_control(
								array(
									'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Link text', 'conversions' ), $this->id, 'customizer_repeater_linktext_control' ),
									'class' => 'customizer-repeater-linktext-control',
									'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_linktext_control' ),
								),
								$linktext
							);
						}
						if ( $this->customizer_repeater_link_control ) {
							$this->input_control(
								array(
									'label'             => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Link', 'conversions' ), $this->id, 'customizer_repeater_link_control' ),
									'class'             => 'customizer-repeater-link-control',
									'sanitize_callback' => 'esc_url_raw',
									'type'              => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
								),
								$link
							);
						}
						if ( true == $this->customizer_repeater_repeater_control ) {
							$this->repeater_control( $repeater );
						}

						if ( ! empty( $id ) ) {
							$id = $id;
						} else {
							$id = '';
						}
						echo '<input type="hidden" class="social-repeater-box-id" value="' . esc_attr( $id ) . '">';

						if ( 0 == $it ) {
							$sr_delete_field = 'style="display:none;"';
						} else {
							$sr_delete_field = '';
						}
						echo '<button type="button" class="social-repeater-general-control-remove-field" ' . esc_attr( $sr_delete_field ) . '>' . esc_html__( 'Delete field', 'conversions' ) . '</button>';
						?>
					</div>
				</div>

				<?php
				$it++;
			}
		} else {
			?>
			<div class="customizer-repeater-general-control-repeater-container">
				<div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ); ?>
				</div>
				<div class="customizer-repeater-box-content-hidden">
					<?php
					if ( true == $this->customizer_repeater_image_control && true == $this->customizer_repeater_icon_control ) {
						$this->icon_type_choice();
					}
					if ( true == $this->customizer_repeater_image_control ) {
						$this->image_control();
					}
					if ( true == $this->customizer_repeater_icon_control ) {
						$this->icon_picker_control();
					}
					if ( true == $this->customizer_repeater_color_control ) {
						$this->input_control(
							array(
								'label'             => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Color', 'conversions' ), $this->id, 'customizer_repeater_color_control' ),
								'class'             => 'customizer-repeater-color-control',
								'type'              => apply_filters( 'conversions_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
								'sanitize_callback' => 'sanitize_hex_color',
							)
						);
					}
					if ( true == $this->customizer_repeater_title_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Title', 'conversions' ), $this->id, 'customizer_repeater_title_control' ),
								'class' => 'customizer-repeater-title-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_subtitle_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Subtitle', 'conversions' ), $this->id, 'customizer_repeater_subtitle_control' ),
								'class' => 'customizer-repeater-subtitle-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_subtitle2_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Subtitle', 'conversions' ), $this->id, 'customizer_repeater_subtitle2_control' ),
								'class' => 'customizer-repeater-subtitle2-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle2_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_text_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Text', 'conversions' ), $this->id, 'customizer_repeater_text_control' ),
								'class' => 'customizer-repeater-text-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_linktext_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Link text', 'conversions' ), $this->id, 'customizer_repeater_linktext_control' ),
								'class' => 'customizer-repeater-linktext-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_linktext_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_link_control ) {
						$this->input_control(
							array(
								'label' => apply_filters( 'conversions_repeater_labels_filter', esc_html__( 'Link', 'conversions' ), $this->id, 'customizer_repeater_link_control' ),
								'class' => 'customizer-repeater-link-control',
								'type'  => apply_filters( 'conversions_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
							)
						);
					}
					if ( true == $this->customizer_repeater_repeater_control ) {
						$this->repeater_control();
					}
					?>
					<input type="hidden" class="social-repeater-box-id">
					<button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'conversions' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Input control
	 *
	 * @param array  $options Options.
	 * @param string $value Value.
	 */
	private function input_control( $options, $value = '' ) {

		if ( ! empty( $options['type'] ) ) {
			switch ( $options['type'] ) {
				case 'textarea':
					?>
					<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
					<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( ! empty( $options['sanitize_callback'] ) ? call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></textarea>
					<?php
					break;
				case 'color':
					?>
					<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
					<div class="<?php echo esc_attr( $options['class'] ); ?>">
						<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ? call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" class="<?php echo esc_attr( $options['class'] ); ?>" />
					</div>
					<?php
					break;
			}
		} else {
			?>
			<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
			<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ? call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}

	/**
	 * Icon picker control
	 *
	 * @param string $value Value.
	 * @param string $show Show or not.
	 */
	private function icon_picker_control( $value = '', $show = '' ) {
		?>
		<div class="social-repeater-general-control-icon" <?php if ( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Icon', 'conversions' ); ?>
			</span>
			<span class="description customize-control-description">
				<?php
					echo sprintf(
						/* translators: 1: <a href...>Fontawesome</a> */
						esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'conversions' ),
						sprintf(
							'<a href="%s" rel="nofollow" target="_blank">%s</a>',
							esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ),
							esc_html__( 'Fontawesome', 'conversions' )
						)
					);
				?>
			</span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php if ( ! empty( $value ) ) { echo esc_attr( $value ); } ?>" type="text">
				<span class="input-group-addon">
					<i class="cr__icon <?php echo esc_attr( $value ); ?>"></i>
				</span>
			</div>
			<?php get_template_part( $this->customizer_icon_container ); ?>
		</div>
		<?php
	}

	/**
	 * Image control
	 *
	 * @param string $value Value.
	 * @param string $show Show or not.
	 */
	private function image_control( $value = '', $show = '' ) {
		?>
		<div class="customizer-repeater-image-control" <?php if ( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Image', 'conversions' ); ?>
			</span>
			<input type="text" class="widefat custom-media-url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary customizer-repeater-custom-media-button" value="<?php esc_attr_e( 'Upload Image', 'conversions' ); ?>" />
		</div>
		<?php
	}

	/**
	 * Icon/Image/None select control
	 *
	 * @param string $value Select control type.
	 */
	private function icon_type_choice( $value = 'customizer_repeater_icon' ) {
		?>
		<span class="customize-control-title">
			<?php esc_html_e( 'Image type', 'conversions' ); ?>
		</span>
		<select class="customizer-repeater-image-choice">
			<option value="customizer_repeater_icon" <?php selected( $value, 'customizer_repeater_icon' ); ?>><?php esc_html_e( 'Icon', 'conversions' ); ?></option>
			<option value="customizer_repeater_image" <?php selected( $value, 'customizer_repeater_image' ); ?>><?php esc_html_e( 'Image', 'conversions' ); ?></option>
			<option value="customizer_repeater_none" <?php selected( $value, 'customizer_repeater_none' ); ?>><?php esc_html_e( 'None', 'conversions' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Repeater control
	 *
	 * @param string $value Value.
	 */
	private function repeater_control( $value = '' ) {
		$feature_repeater = array();
		$show_del         = 0;
		?>
		<span class="customize-control-title"><?php esc_html_e( 'Features', 'conversions' ); ?></span>
		<?php
		if ( ! empty( $value ) ) {
			$feature_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $feature_repeater ) == 1 && '' === $feature_repeater[0] ) || empty( $feature_repeater ) ) {
			?>
			<div class="customizer-repeater-feature-repeater">
				<div class="customizer-repeater-feature-repeater-container">
					<input type="text" class="customizer-repeater-feature-repeater-text"
						placeholder="<?php esc_attr_e( 'Feature', 'conversions' ); ?>">
					<input type="hidden" class="customizer-repeater-feature-repeater-id" value="">
					<button class="feature-repeater-remove-feature-item" style="display:none">
						<?php esc_html_e( 'Remove Feature', 'conversions' ); ?>
					</button>
				</div>
				<input type="hidden" id="feature-repeater-features-repeater-collector" class="feature-repeater-features-repeater-collector" value=""/>
			</div>
			<button class="feature-repeater-add-feature-item button-secondary"><?php esc_html_e( 'Add Feature', 'conversions' ); ?></button>
			<?php
		} else {
			?>
			<div class="customizer-repeater-feature-repeater">
				<?php
				foreach ( $feature_repeater as $feat ) {
					$show_del ++;
					?>
					<div class="customizer-repeater-feature-repeater-container">
						<input type="text" class="customizer-repeater-feature-repeater-text"
							placeholder="<?php esc_attr_e( 'Feature', 'conversions' ); ?>"
							value="<?php if ( ! empty( $feat['feature'] ) ) {
								echo esc_html( $feat['feature'] );
							} ?>">
						<input type="hidden" class="customizer-repeater-feature-repeater-id"
							value="<?php if ( ! empty( $feat['id'] ) ) {
								echo esc_attr( $feat['id'] );
							} ?>">
						<button class="feature-repeater-remove-feature-item"
							style="<?php if ( 1 == $show_del ) {
								echo 'display:none';
							} ?>"><?php esc_html_e( 'Remove Feature', 'conversions' ); ?></button>
					</div>
					<?php
				}
				?>
				<input type="hidden" id="feature-repeater-features-repeater-collector"
					class="feature-repeater-features-repeater-collector"
					value="<?php echo esc_textarea( html_entity_decode( $value ) ); ?>" />
			</div>
			<button class="feature-repeater-add-feature-item button-secondary"><?php esc_html_e( 'Add Feature', 'conversions' ); ?></button>
			<?php
		}
	}
}
