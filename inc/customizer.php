<?php
/**
 * カスタマイザー
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 不要項目の削除
 */
if ( ! function_exists( 'theme_customize_register' ) ) {
	function customize_register_custom_demo( $wp_customize ) {
		$wp_customize->remove_section('static_front_page');
	}
}
add_action( 'customize_register', 'customize_register_custom_demo' );

/**
 * 追加の設定
 */
if ( ! function_exists( 'theme_customize_register' ) ) {
	function theme_customize_register( $wp_customize ) {

		/**
		 * カスタマイズメニュー
		 */
		$wp_customize->add_section(
			'setting_font_size',
			array(
				'title'    => 'フォントサイズ ( mobile )',
				'priority' => 1,
			)
		);
		$wp_customize->add_section(
			'setting_font_size_md',
			array(
				'title'    => 'フォントサイズ ( tablet, desktop )',
				'priority' => 2,
			)
		);
		$wp_customize->add_section(
			'setting_font_family',
			array(
				'title'    => 'フォントファミリー',
				'priority' => 3,
			)
		);


		/**
		 * フォントサイズ項目 - mobile
		 */
		$wp_customize->add_setting( 'sm_fz_2xs', array( 'default'  => '10', ) );
		$wp_customize->add_setting( 'sm_fz_xs', array( 'default'  => '11', ) );
		$wp_customize->add_setting( 'sm_fz_sm', array( 'default'  => '12', ) );
		$wp_customize->add_setting( 'sm_fz_md', array( 'default'  => '14', ) );
		$wp_customize->add_setting( 'sm_fz_lg', array( 'default'  => '16', ) );
		$wp_customize->add_setting( 'sm_fz_xl', array( 'default'  => '18', ) );
		$wp_customize->add_setting( 'sm_fz_2xl', array( 'default'  => '22', ) );
		$wp_customize->add_setting( 'sm_fz_3xl', array( 'default'  => '28', ) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_2xs',
				array(
					'label'       => '最小',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_xs',
				array(
					'label'       => '特小',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_sm',
				array(
					'label'       => '小',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_md',
				array(
					'label'       => '標準',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_lg',
				array(
					'label'       => '大',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_xl',
				array(
					'label'       => '特大',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_2xl',
				array(
					'label'       => '巨大',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sm_fz_3xl',
				array(
					'label'       => '最大',
					'description' => '',
					'section'     => 'setting_font_size',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);



		/**
		 * フォントサイズ項目 - tablet, desktop
		 */
		$wp_customize->add_setting( 'md_fz_2xs', array( 'default'  => '11', ) );
		$wp_customize->add_setting( 'md_fz_xs', array( 'default'  => '13', ) );
		$wp_customize->add_setting( 'md_fz_sm', array( 'default'  => '14', ) );
		$wp_customize->add_setting( 'md_fz_md', array( 'default'  => '16', ) );
		$wp_customize->add_setting( 'md_fz_lg', array( 'default'  => '18', ) );
		$wp_customize->add_setting( 'md_fz_xl', array( 'default'  => '21', ) );
		$wp_customize->add_setting( 'md_fz_2xl', array( 'default'  => '26', ) );
		$wp_customize->add_setting( 'md_fz_3xl', array( 'default'  => '32', 'type' => 'option',  'capability' => 'edit_theme_options', 'transport' => 'postMessage', ) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_2xs',
				array(
					'label'       => '最小',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_xs',
				array(
					'label'       => '特小',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_sm',
				array(
					'label'       => '小',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_md',
				array(
					'label'       => '標準',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_lg',
				array(
					'label'       => '大',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_xl',
				array(
					'label'       => '特大',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_2xl',
				array(
					'label'       => '巨大',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'md_fz_3xl',
				array(
					'label'       => '最大',
					'description' => '',
					'section'     => 'setting_font_size_md',
					'priority'    => 1,
					'type'        => 'number',
				)
			)
		);



		/**
		 * フォントファミリー項目
		 */
		$wp_customize->add_setting( 'font_primary', array( 'default'  => '', ) );
		$wp_customize->add_setting( 'font_secondary', array( 'default'  => '', ) );
		$wp_customize->add_setting( 'font_import', array( 'default'  => '', ) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'font_primary',
				array(
					'label'       => 'プライマリーフォント',
					'description' => '主に文章で使用します。',
					'section'     => 'setting_font_family',
					'priority'    => 1,
					'type'        => 'text',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'font_secondary',
				array(
					'label'       => 'セカンダリーフォント',
					'description' => '主に英字のタイトルで使用します。',
					'section'     => 'setting_font_family',
					'priority'    => 1,
					'type'        => 'text',
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Code_Editor_Control(
				$wp_customize,
				'font_import',
				array(
					'label'       => 'インポートURL',
					'description' => '外部URLなどから読み込むパスを設定します。<br>※ Oswald についてはテーマCSSでインポート済み',
					'section'     => 'setting_font_family',
					'priority'    => 1,
					//'type'        => 'textarea',
				)
			)
		);


	}
}
add_action( 'customize_register', 'theme_customize_register' );

