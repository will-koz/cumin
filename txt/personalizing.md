# Personalizing

To begin, create a JSON object that has a `name` string field, `version` number field, and a
`styles` array of strings, like so:
```
{
	"name" : "Startpage",
	"version" : 1,
	"styles" : ["style1.css"]
}
```
in etc/index.json. The `styles` strings are styles that are loaded no matter what frame is loaded.
The styles are relative to etc/. Next, create an array of objects titled `page`. (Reminder that you
can look at [example.json](../etc/example.json) if you have questions about Cumin input, or if my
documentation is terrible.)

Cumin takes a frame from the inside of the `page` object. (This can be specified in the `frame` GET
variable.) The documentation for writing a frame is kept in [Keywords.md](Keywords.md). For each
page, the `content` field is an array of items. I would recomend not adding a string to the
`favicon` field because it will default to `favicon.ico` and it is incredibly rare that the favicon
should be changed, but if necessary, the `favicon` field changes the icon that is rendered in the
title bar.
