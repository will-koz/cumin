# Keyword Guide

If you don't want to read the source in [../lib/divs.php](../lib/divs.php) for each item, you can
refer to this list of keywords. Each item has a five letter identifier that is used for that class.
It is recommended these identifiers are not used in custom CSS files, in addition to the `item`
class.

For all items, the `classes` field is an array of additional classes that item is a part of.

- **ClCpy** Text field for clipboard copying.
  - `content` The text to be shown in the content of the item.
  - `copy` The text to be copied and shown in mouseover text.
  - `delimiter` *Optional* The type of delimiter following the item. `hr` for horizontal line.
- **Clock** Clock that updates every second.
  - `delimiter` *Optional* The type of delimiter following the item. `hr` for horizontal line.
- **Image** Image item.
  - `src` Source relative to [index.php](../index.php)
- **ImgCl** Image item for clipboard copying.
  - `copy` The text to be copied and shown in mouseover text.
  - `src` Source relative to [index.php](../index.php)
- **ImgLk** Image item that also serves as a link.
  - `href` The link destination.
  - `src` Source relative to [index.php](../index.php)
- **Searc** Search engine for custom URL
  - `delimiter` *Optional* They type of delimiter following the item. `hr` for horizontal line.
  - `name` The GET variable in the search URL / form item name
  - `placeholder` *Optional* The placeholder text for the search bar.
  - `url` URL of search
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

## Additional Reserved Classes

- `clock` related:
  - **cabov** *Clock Above (Clock Hour, Clock Minute, Clock Second)*
  - **cbelw** *Clock Below (Clock Year, Clock Month, Clock Date)*
  - **cdate** *Clock Date*
  - **chour** *Clock Hour*
  - **cminu** *Clock Minute*
  - **cmnth** *Clock Month*
  - **cscnd** *Clock Second*
  - **cyear** *Clock Year*
  - **isodt** *Not used anywhere, but reserved for Cumin mods.*
- **image-img**
- **item**
