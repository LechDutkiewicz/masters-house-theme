<?php if ( ! defined( 'ABSPATH' ) ) exit('No direct script access allowed'); // Exit if accessed directly

/**
 * Custom Post Type Class
 *
 *
 *
 * @author		Hermanto Lim
 * @copyright	Copyright (c) Hermanto Lim
 * @link		http://bonfirelab.com
 * @since		Version 1.0
 * @package 	BonFramework
 * @category 	Core
 *
 *
*/ 

class BON_Cpt
	{
		public $post_type_name;
		public $post_type_args;
		public $post_type_labels;
		public $post_type_singular;
		public $post_type_plural;
		
		/* Class constructor */
		public function __construct( )
		{
			
		}

		public function create($name, $args = array(), $labels = array(), $singular = '', $plural = '' ) {
			// Set some important variables
			$this->post_type_name		= strtolower( str_replace( ' ', '-', $name ) );
			$this->post_type_args 		= $args;
			$this->post_type_singular 	= $singular;
			$this->post_type_plural		= $plural;
			$this->post_type_labels 	= $labels;

			// Add action to register the post type, if the post type doesnt exist
			if( ! post_type_exists( $this->post_type_name ) ) {
				add_action( 'init', array( &$this, 'register_post_type' ) );
			}

			// Listen for the save post hook
			$this->save();
		}
		
		/* Method which registers the post type */
		public function register_post_type() {		
			//Capitilize the words and make it plural
			//$name 		= ucwords( str_replace( '-', ' ', $this->post_type_name ) );
			//$plural 	= $name . 's';
			$name = !empty( $this->post_type_singular ) ? $this->post_type_singular : ucwords( str_replace( '-', ' ', $this->post_type_name ) );
			$plural = !empty( $this->post_type_plural ) ? $this->post_type_plural : $name . 's';

			// We set the default labels based on the post type name and plural. We overwrite them with the given labels.
			$labels = array_merge(

				// Default
				array(
					'name' 					=> _x( $plural, 'post type general name' ),
					'singular_name' 		=> _x( $name, 'post type singular name' ),
					'add_new' 				=> _x( 'Add New', strtolower( $name ) ),
					'add_new_item' 			=> sprintf(__( 'Add New %s', 'bon' ), $name ),
					'edit_item' 			=> sprintf(__( 'Edit %s', 'bon' ), $name ),
					'new_item' 				=> sprintf(__( 'New %s', 'bon' ), $name ),
					'all_items' 			=> sprintf(__( 'All %s', 'bon' ), $plural ),
					'view_item' 			=> sprintf(__( 'View %s', 'bon' ), $name ),
					'search_items' 			=> sprintf(__( 'Search %s', 'bon' ), $plural),
					'not_found' 			=> sprintf(__( 'No %s found', 'bon' ), strtolower( $plural )),
					'not_found_in_trash' 	=> sprintf(__( 'No %s found in Trash', 'bon' ), strtolower( $plural ) ), 
					'parent_item_colon' 	=> '',
					'menu_name' 			=> $plural
				),

				// Given labels
				$this->post_type_labels

			);

			// Same principle as the labels. We set some default and overwite them with the given arguments.
			$args = array_merge(

				// Default
				array(
					'label' 				=> $plural,
					'labels' 				=> $labels,
					'public' 				=> true,
					'show_ui' 				=> true,
					'supports' 				=> array( 'title', 'editor' ),
					'show_in_nav_menus' 	=> true,
					'_builtin' 				=> false,
				),

				// Given args
				$this->post_type_args

			);
			// Register the post type
			register_post_type( $this->post_type_name, $args );
		}
		
		/* Method to attach the taxonomy to the post type */
		public function add_taxonomy( $name, $args = array(), $labels = array(), $singular = '', $plural = '' ) {
			if( ! empty( $name ) ) {			
				// We need to know the post type name, so the new taxonomy can be attached to it.
				$post_type_name = $this->post_type_name;

				// Taxonomy properties
				$taxonomy_name		= strtolower( str_replace( ' ', '-', $name ) );
				$taxonomy_labels	= $labels;
				$taxonomy_args		= $args;
				$taxonomy_singular  = $singular;
				$taxonomy_plural    = $plural;


				if( ! taxonomy_exists( $taxonomy_name ) ) {
						//Capitilize the words and make it plural
							$name 		= !empty( $taxonomy_singular ) ? $taxonomy_singular : ucwords( str_replace( '-', ' ', $name ) );
							$plural 	= !empty( $taxonomy_plural) ? $taxonomy_plural : $name . 's';

							// Default labels, overwrite them with the given labels.
							$labels = array_merge(

								// Default
								array(
									'name' 					=> _x( $plural, 'taxonomy general name' ),
									'singular_name' 		=> _x( $name, 'taxonomy singular name' ),
								    'search_items' 			=> sprintf(__( 'Search %s','bon'), $plural ),
								    'all_items' 			=> sprintf(__( 'All %s','bon'), $plural ),
								    'parent_item' 			=> sprintf(__( 'Parent %s','bon'), $name ),
								    'parent_item_colon' 	=> sprintf(__( 'Parent %s','bon'), $name . ':' ),
								    'edit_item' 			=> sprintf(__( 'Edit %s','bon'), $name ), 
								    'update_item' 			=> sprintf(__( 'Update %s','bon'), $name ),
								    'add_new_item' 			=> sprintf(__( 'Add New %s','bon'), $name ),
								    'new_item_name' 		=> sprintf(__( 'New %s Name','bon'), $name ),
								    'menu_name' 			=> sprintf(__( '%s','bon' ), $name ),
								),

								// Given labels
								$taxonomy_labels

							);

							// Default arguments, overwitten with the given arguments
							$args = array_merge(

								// Default
								array(
									'label'					=> $plural,
									'labels'				=> $labels,
									'public' 				=> true,
									'show_ui' 				=> true,
									'show_in_nav_menus' 	=> true,
									'_builtin' 				=> false,
								),

								// Given
								$taxonomy_args

							);

							// Add the taxonomy to the post type
							add_action( 'init',
								function() use( $taxonomy_name, $post_type_name, $args ) {						
									register_taxonomy( $taxonomy_name, $post_type_name, $args );
								}
							);
				}
				else {
					add_action( 'init',
							function() use( $taxonomy_name, $post_type_name ) {				
								register_taxonomy_for_object_type( $taxonomy_name, $post_type_name );
							}
						);
				}
			}
		}
		
		/* Attaches meta boxes to the post type */
		public function add_meta_box( $id, $title, $fields = array(), $context = 'normal', $priority = 'high' )
		{
			$this->mb = new BON_Metabox();
			
			if( ! empty( $title ) && !empty( $id ) )
			{		
				// We need to know the Post Type name again
				$post_type_name = $this->post_type_name;

				// Meta variables	
				$box_id 		= $id;
				$box_title		= ucwords( str_replace( '_', ' ', $title ) );
				$box_context	= $context;
				$box_priority	= $priority;
				
				$this->mb->create_box($box_id, $box_title, $fields, $post_type_name, $box_context, $box_priority);
				
			}

		}
		
		/* Listens for when the post type being saved */
		public function save()
		{
			// Need the post type name again
			$post_type_name = $this->post_type_name;

			add_action( 'save_post',
				function() use( $post_type_name )
				{
					// Deny the wordpress autosave function
					if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
					if ( !isset($_POST['bon_custom_post_type']) || ! wp_verify_nonce( $_POST['bon_custom_post_type'], basename(__FILE__) ) ) return;

					global $post;

					if( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $post_type_name )
					{
						global $custom_fields;

						// Loop through each meta box
						foreach( $custom_fields as $title => $fields )
						{
							// Loop through all fields
							foreach( $fields as $label => $type )
							{
								$field_id_name 	= strtolower( str_replace( ' ', '_', $title ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );

								update_post_meta( $post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name] );
							}

						}
					}
				}
			);
		}
	}
?>