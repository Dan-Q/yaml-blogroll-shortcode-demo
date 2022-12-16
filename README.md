## Sample Blogroll Shortcode (from YML) for WordPress

### Description

On 16 December 2022, [Kev Quirk](https://kevquirk.com/) [wrote](https://kevquirk.com/can-i-use-data-files/):

> One of the things I really miss from my days using Jekyll, is the use of data files. Can this be done in WordPress?

Based on his blogpost, I threw together this very basic skeleton plugin that uses a shortcode to loop through a blogroll (stored in YAML format, in the plugin directory, though honestly it could go anywhere). If you wanted a "generic" YAML-to-content tool for WordPress you might have to work a little harder. Or somebody might've already done it. But I just wanted to put something basic together in 20 minutes to show that it could be done, and perhaps provide a jumping-off point for others.

See the original blog post for an understanding of what's being achieved here.

### Installation

1. Put everything into the `wp-content/plugins/danq-blogroll` folder.
2. In that folder, run `composer install` to install dependencies (there's only one dependency, the Symphony YAML parser: if you can install the PECL YAML parser you can probably use that instead, but my approach will work even if you don't have root on your server).
3. Create `blogroll.yml` in that directory; you can copy `blogroll.yml.example` if you like.
4. Activate the plugin in the usual way.

### Usage

Put the shortcode `[blogroll]` anywhere you like on your site: in page content, in a paragraph block in a widget area, wherever. I've opted for a shortcode for speed, simplicity, and backwards-compatibility, but you could reimplement as a Gutenberg block if that's your preferred poison.

### Next steps

If you want to expand this into something generic, perhaps you're looking for a shortcode that looks something like this - a template inside a shortcode that specifies the data file:

```
<ul>
  [yaml_looper file="blogroll.yml"]
    <li>
      <a target="_blank" href="{{link}}">{{name}}</a>
      (<a href="{{rss}}">RSS feed</a>)
    </li>
  [/yaml_looper]
</ul>
```

Implementation is left as an exercise for the reader.
