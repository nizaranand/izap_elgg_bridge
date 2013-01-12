<?php
/**
 * Embeddable content list item view
 *
 * @uses $vars['entity'] ElggEntity object
 */

$entity = $vars['entity'];

$title = $entity->title;
if (!$title) {
	$title = $entity->name;
}

// different entity types have different title attribute names.
$title = isset($entity->name) ? $entity->name : $entity->title;
// don't let it be too long
$title = elgg_get_excerpt($title);

$owner = $entity->getOwnerEntity();
if ($owner) {
	$author_text = elgg_echo('byline', array($owner->name));
	$date = elgg_view_friendly_time($entity->time_created);
	$subtitle = "$author_text $date";
} else {
	$subtitle = '';
}

$embed_link = elgg_view('output/url', array(
    'href' => "#hj-embed-options-$entity->guid",
    'rel' => 'toggle',
    'text' => elgg_echo('hj:framework:embed:options')
));

$embed_options = elgg_view('embed/options', array('entity' => $entity));

$params = array(
	'title' => $title,
	'entity' => $entity,
	'subtitle' => $subtitle,
        'content' => $embed_link . $embed_options,
	'tags' => FALSE,
);
$body = elgg_view('object/elements/summary', $params);

$image = elgg_view_entity_icon($entity, 'small', array('link_class' => 'embed-insert'));


echo elgg_view_image_block($image, $body);
