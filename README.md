# Cumin

Cumin is a custom startpage engine. It is so named because creating startpages can be really spicy,
and this engine is really dull compared to all the other spices, but it gets the job done; and not
because it was the first recommendation from GitHub when I was creating this repo.

**Please feel free to make an issue if there are glaring mistakes.** With that out of the way, to
run Cumin, go to [Running](#Running).

![Logo](logo/logo.svg)

## Running

1. Make sure you have [Apache](https://httpd.apache.org/download.cgi) and
[PHP](https://www.php.net/downloads.php) installed for your distribution or operating system. I
would recommend using the appropriate package manager (or inappropriate one, idc) instead of
downloading from the website.
2. Change directory to the root location for your http server (probably `/var/www/html`).
3. Run `git clone https://github.com/will-koz/cumin`, or whatever the forked location is.
4. Create `etc/index.json` and `etc/custom/`.
5. Personalize `etc/index.json` to your liking. Or don't personalize it to your liking. Or don't
personalize it at all. `etc/custom/` is reserved for custom CSS, custom JavaScript, etc...

## TODO

TODO list kept in [txt/TODO.md](txt/TODO.md).


## Notes

- In Firefox (and possibly other browsers), Enhanced Tracking protection blocks fetching data from
other websites. I know this blocks reddit, but doesn't block wttr.in. I don't recommend removing
Enhanced Tracking protection, but it does break dynamic topic backgrounds.
