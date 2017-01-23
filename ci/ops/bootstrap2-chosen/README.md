# bootstrap-chosen.sass

![](https://github.com/alxlit/bootstrap-chosen/raw/master/example.png)

An alternate stylesheet for [Chosen](http://harvesthq.github.com/chosen/). This
one is supposed to integrate better with Bootstrap 2 (v 2.3.x specifically)

## Usage

Chosen widgets are given the `outerWidth` of the form element that they are
replacing, which is ambiguous and often not what you'd expect. Wrap them with
the "chosen" class (or chosen-mini, chosen-small, etc) to fix this.

```html
<div class="chosen">
  <select class="chosen-select">
    <option>...</option>
  </select>
</div>
```

How you add `bootstrap-chosen.scss` to you build process is up to you. Just keep in mind
that it needs access to any other required `.scss`.

License: [MIT](https://en.wikipedia.org/wiki/MIT_License)

