<?php
/**
 * Elgg file plugin language pack
 *
 * @package ElggFile
 */

$russian = array(

	/**
	 * Menu items and titles
	 */
	'file' => "Файлы",
	'file:user' => "Файлы пользователя %s'",
	'file:friends' => "Файлы друзей",
	'file:all' => "Все файлы",
	'file:edit' => "Редактировать файл",
	'file:more' => "Еще файлы",
	'file:list' => "в виде списка",
	'file:group' => "Файлы группы",
	'file:gallery' => "в виде галереи",
	'file:gallery_list' => "В виде галереи или списка",
	'file:num_files' => "Число отображаемых файлов",
	'file:user:gallery'=>'Просмотреть галерею %s',
	'file:via' => 'через файлы',
	'file:upload' => "Загрузить файл",
	'file:replace' => 'Заменить файл (оставьте пустым чтобы не менять файл)',
	'file:list:title' => "%s's %s %s",
	'file:title:friends' => "Friends'",

	'file:add' => 'Загрузить файл',

	'file:file' => "Файл",
	'file:title' => "Название",
	'file:desc' => "Описание",
	'file:tags' => "Теги",

	'file:types' => "Типы загружаемых файлов",

	'file:type:' => 'Файлы',
	'file:type:all' => "Все файлы",
	'file:type:video' => "Видео",
	'file:type:document' => "Документы",
	'file:type:audio' => "Аудио",
	'file:type:image' => "Изображения",
	'file:type:general' => "Основные файлы",

	'file:user:type:video' => "Видео %s",
	'file:user:type:document' => "Документы %s",
	'file:user:type:audio' => "Аудио %s",
	'file:user:type:image' => "Изображения %s",
	'file:user:type:general' => "Основные файлы %s",

	'file:friends:type:video' => "Видео Ваших друзей",
	'file:friends:type:document' => "Документы Ваших друзей",
	'file:friends:type:audio' => "Аудио Ваших друзей",
	'file:friends:type:image' => "Изображения Ваших друзей",
	'file:friends:type:general' => "Основные файлы Ваших друзей",

	'file:widget' => "Файлы",
	'file:widget:description' => "Ваши последние файлы",

	'groups:enablefiles' => 'Включить файлы в группе',

	'file:download' => "Скачать",

	'file:delete:confirm' => "Удалить этот файл?",

	'file:tagcloud' => "Облако тегов",

	'file:display:number' => "Число отображаемых файлов",

	'river:create:object:file' => '%s загрузил(а) файл %s',
	'river:comment:object:file' => '%s комментировал(а) файл %s',

	'item:object:file' => 'Файлы',

	/**
	 * Embed media
	 **/

		'file:embed' => "Вложенное",
		'file:embedall' => "Все",

	/**
	 * Status messages
	 */

		'file:saved' => "Ваш файл успешно сохранен.",
		'file:deleted' => "Ваш файл успешно удален.",

	/**
	 * Error messages
	 */

		'file:none' => "Файлов нет.",
		'file:uploadfailed' => "Простите, файл не сохранен.",
		'file:downloadfailed' => "Простите, файл сейчас недоступен.",
		'file:deletefailed' => "Простите, файл не удален.",
		'file:noaccess' => "У Вас нет прав для изменения этого файла.",
		'file:cannotload' => "Простите, произошла ошибка при загрузке файла. Попробуйте снова.",
		'file:nofile' => "Вам нужно выбрать файл",
);

add_translation("ru", $russian);