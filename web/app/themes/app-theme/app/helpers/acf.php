<?php

/**
 * Handle case when get_field returns null
 *
 * @param string $selector
 * @param mixed $default_value
 * @param bool|int $post_id
 *
 * @return mixed
 */
function gf( string $selector, $default_value = false, $post_id = false ) {
	$field_value = get_field( $selector, $post_id );

	return $field_value ?? $default_value;
}
