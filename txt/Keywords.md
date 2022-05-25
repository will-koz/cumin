#Keyword Guide

If you don't want to read the source in [../lib/divs.php](../lib/divs.php) for each item, you can
refer to this list of keywords. Each item has a five letter identifier that is used for that class.
It is recommended these identifiers are not used in custom CSS files, in addition to the `item`
class.

For all items, the `classes` field is an array of additional classes that item is a part of.

- **ClCpy** Text field for clipboard copying.
  - `content` The text to be shown in the content of the item.
  - `copy` The text to be copied and shown in mouseover text.
  - `delimiter` *Optional* The type of delimiter following the item. `hr` for horizontal line.
- **XFile** Text field from external file.
  - `content` The file from which text is to be taken.
  - `delimiter` *Optional* The type of delimiter following the item. `hr` for horizontal line.
- **XLink** Text link.
  - `content` The text to be shown in the content of the item.
  - `delimiter` *Optional* The type fo delimiter following the item. `hr` for horizontal line.
  - `href` The link destination.
- **XText** Basic Text field.
  - `content` The text to be shown in the content of the item.
  - `delimiter` *Optional* The type of delimiter following the item. `hr` for horizontal line.
