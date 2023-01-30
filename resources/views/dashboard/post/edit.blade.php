@extends('layouts.dashboard')

@section('content')
{{-- Tags Input --}}
<style>
  .tagger {
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
    overflow: scroll;
  }
  .tagger input[type="hidden"] {
    /* fix for bootsrap */
    display: none;
  }
  .tagger > ul {
    display: flex;
    width: 100%;
    align-items: center;
    padding: 4px 6px;
    justify-content: space-between;
    box-sizing: border-box;
  }
  .tagger ul {
    margin: 0;
    list-style: none;
  }
  .tagger > ul > li:not(.tagger-new) + li {
    padding-left: 10px;
  }
  .tagger > ul > li:not(.tagger-new) a,
  .tagger > ul > li:not(.tagger-new) a:visited,
  .tagger-new ul a,
  .tagger-new ul a:visited {
    color: #ffffff;
  }
  .tagger > ul > li:not(.tagger-new) > a,
  .tagger li:not(.tagger-new) > span,
  .tagger .tagger-new ul {
    padding: 4px 4px 4px 8px;
    background: #c4183c;
    border: 1px solid #c4183c;
    border-radius: 3px;
  }
  .tagger li a.close {
    padding: 4px;
    margin-left: 4px;
    /* for bootsrap */
    float: none;
    filter: alpha(opacity=100);
    opacity: 1;
    font-size: 16px;
  }
  .tagger li a.close:hover {
    color: white;
  }
  .tagger li:not(.tagger-new) a {
    text-decoration: none;
  }
  .tagger .tagger-new input {
    border: none;
    outline: none;
    box-shadow: none;
    width: 100%;
    padding-left: 0;
    background: transparent;
  }
  .tagger .tagger-new {
    flex-grow: 1;
    position: relative;
  }
  .tagger .tagger-new ul {
    padding: 5px;
  }
  .tagger .tagger-completion {
    position: relative;
    z-index: 100;
  }
</style>
{{-- Tags Input End --}}

<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Posts</span>
      <h3 class="page-title">Edit Post To Update</h3>
    </div>
  </div>
  <!-- End Page Header -->

@if (count($categories) > 0)
  {!! Form::open(['route' => ['post.update', $post->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3']) !!}
    @csrf
    {!! Form::hidden('_method', 'PUT') !!}
  <div class="row">

    <!-- Add New Post Form -->
    <div class="col-lg-9 col-md-12">
      <div class="card card-small mb-3">
        <div class="card-body">
            {!! Form::select('category', $post_categories, $category_slug, ['class' => 'form-control my-4']) !!}
            {!! Form::text('post_title', $post->title, ['class' => 'form-control mb-4', 'placeholder' => 'Post Title', 'required']) !!}
            {!! Form::select('type', [0 => 'Latest', 1 => 'Featured', 2 => 'Breaking'], $post->featured, ['class' => 'form-control mb-4']) !!}
            <div class="mb-4">
              {!! Form::text('tags', $post->tags, ['class' => 'form-control form-control-lg mb-4', 'placeholder' => 'Tags', 'required']) !!}
            </div>
            {!! Form::textarea('description', $post->description, ['required', 'id' => 'description', 'class' => 'add-new-post__editor mb-1']) !!}
        </div>
      </div>
    </div>
    <!-- / Add New Post Form -->

    <div class="col-lg-3 col-md-12">

      <!-- Post Image -->
      <div class='card card-small mb-3'>
        <div class="card-header border-bottom">
          <h6 class="m-0">Featured Image</h6>
        </div>
        <div class='card-body p-0'>
          <div class="p-3">
            <div class="d-flex">
              <img src="{{ asset('uploads/posts/'.$post->image) }}" alt="" id="uploadPreview" class="w-100">
            </div>
            <div class="d-flex my-3">
              {!! Form::file('image',  ['class' => 'form-control my-4', 'placeholder' => 'Featured Image', 'id' => 'uploadImage', 'onchange' => 'readURL(this);', 'accept' => 'image/gif, image/jpeg, image/png']) !!}
            </div>
          </div>
        </div>
      </div>
      <!-- / Post Image -->

      <!--  Publish -->
      <div class="card card-small mb-3">
        <div class="card-body">
          <div class="d-flex my-3">
            <button class="btn btn-sm btn-accent m-auto" type="submit">
              <i class="material-icons">file_copy</i> Publish
            </button>
          </div>
        </div>
      </div>
      <!-- / Publish -->

    </div>
  </div>
  {!! Form::close() !!}
</div>
@else
    <p>Edit Post</p>
@endif

{{-- Tags Input --}}
<script>

  (function(root, factory, undefined) {
    if (typeof define === 'function' && define.amd) {
        define([], factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory();
    } else {
        root.tagger = factory();
    }
  })(typeof window !== 'undefined' ? window : global, function(undefined) {
    // ------------------------------------------------------------------------------------------
    var get_text = (function() {
        var div = document.createElement('div');
        var text = ('innerText' in div) ? 'innerText' : 'textContent';
        return function(element) {
            return element[text];
        };
    })();
    // ------------------------------------------------------------------------------------------
    function tagger(input, options) {
        if (input.length) {
            return Array.from(input).map(function(input) {
                return new tagger(input, options);
            });
        }
        if (!(this instanceof tagger)) {
            return new tagger(input, options);
        }
        var settings = merge({}, tagger.defaults, options);
        this.init(input, settings);
    }
    // ------------------------------------------------------------------------------------------
    function merge() {
        if (arguments.length < 2) {
            return arguments[0];
        }
        var target = arguments[0];
        [].slice.call(arguments).reduce(function(acc, obj) {
            if (is_object(obj)) {
                Object.keys(obj).forEach(function(key) {
                    if (is_object(obj[key])) {
                        if (is_object(acc[key])) {
                            acc[key] = merge({}, acc[key], obj[key]);
                            return;
                        }
                    }
                    acc[key] = obj[key];
                });
            }
            return acc;
        });
        return target;
    }
    // ------------------------------------------------------------------------------------------
    function is_object(arg) {
        if (typeof arg !== 'object' || arg === null) {
            return false;
        }
        return Object.prototype.toString.call(arg) === '[object Object]';
    }
    // ------------------------------------------------------------------------------------------
    function create(tag, attrs, children) {
        tag = document.createElement(tag);
        Object.keys(attrs).forEach(function(name) {
            if (name === 'style') {
                Object.keys(attrs.style).forEach(function(name) {
                    tag.style[name] = attrs.style[name];
                });
            } else {
                tag.setAttribute(name, attrs[name]);
            }
        });
        if (children !== undefined) {
            children.forEach(function(child) {
                var node;
                if (typeof child === 'string') {
                    node = document.createTextNode(child);
                } else {
                    node = create.apply(null, child);
                }
                tag.appendChild(node);
            });
        }
        return tag;
    }
    var id = 0;
    // ------------------------------------------------------------------------------------------
    tagger.defaults = {
        allow_duplicates: false,
        allow_spaces: true,
        completion: {
            list: [],
            delay: 400,
            min_length: 2
        },
        link: function(name) {
            return '/tag/' + name;
        }
    };
    // ------------------------------------------------------------------------------------------
    tagger.fn = tagger.prototype = {
        init: function(input, settings) {
            this._id = ++id;
            var self = this;
            this._settings = settings;
            this._ul = document.createElement('ul');
            this._input = input;
            var wrapper = document.createElement('div');
            wrapper.className = 'tagger';
            this._input.setAttribute('hidden', 'hidden');
            this._input.setAttribute('type', 'hidden');
            var li = document.createElement('li');
            li.className = 'tagger-new';
            this._new_input_tag = document.createElement('input');
            this.tags_from_input();
            li.appendChild(this._new_input_tag);
            this._completion = document.createElement('div');
            this._completion.className = 'tagger-completion';
            this._ul.appendChild(li);
            input.parentNode.replaceChild(wrapper, input);
            wrapper.appendChild(input);
            wrapper.appendChild(this._ul);
            li.appendChild(this._completion);
            this._add_events();
            if (this._settings.completion.list instanceof Array) {
                this._build_completion(this._settings.completion.list);
            }
        },
        // --------------------------------------------------------------------------------------
        _add_events: function() {
            var self = this;
            this._ul.addEventListener('click', function(event) {
                if (event.target.className.match(/close/)) {
                    self.remove_tag(event.target);
                    event.preventDefault();
                }
            });
            // ----------------------------------------------------------------------------------
            this._new_input_tag.addEventListener('keydown', function(event) {
                if (event.keyCode === 13 || event.keyCode === 188 ||
                    (event.keyCode === 32 && !self._settings.allow_spaces)) { // enter || comma || space
                    if (self.add_tag(self._new_input_tag.value.trim())) {
                        self._new_input_tag.value = '';
                    }
                    event.preventDefault();
                } else if (event.keyCode === 8 && !self._new_input_tag.value) { // backspace
                    if (self._tags.length > 0) {
                        var li = self._ul.querySelector('li:nth-last-child(2)');
                        self._ul.removeChild(li);
                        self._tags.pop();
                    }
                    event.preventDefault();
                } else if (event.keyCode === 32 && (event.ctrlKey || event.metaKey)) {
                    if (typeof self._settings.completion.list === 'function') {
                        self.complete(self._new_input_tag.value);
                    }
                    self._toggle_completion(true);
                    event.preventDefault();
                }
            });
            // ----------------------------------------------------------------------------------
            this._new_input_tag.addEventListener('input', function(event) {
                var value = self._new_input_tag.value;
                if (self._tag_selected(value)) {
                    if (self.add_tag(value)) {
                        self._toggle_completion(false);
                        self._new_input_tag.value = '';
                    }
                } else {
                    if (typeof self._settings.completion.list === 'function') {
                        self.complete(value);
                    }
                    var min = self._settings.completion.min_length;
                    self._toggle_completion(value.length >= min);
                }
            });
            // ----------------------------------------------------------------------------------
            this._completion.addEventListener('click', function(event) {
                if (event.target.tagName.toLowerCase() === 'a') {
                    self.add_tag(get_text(event.target));
                    self._new_input_tag.value = '';
                    self._completion.innerHTML = '';
                }
            });
        },
        // --------------------------------------------------------------------------------------
        _tag_selected: function(tag) {
            return this._last_completion && this._last_completion.includes(tag);
        },
        // --------------------------------------------------------------------------------------
        _toggle_completion: function(toggle) {
            if (toggle) {
                this._new_input_tag.setAttribute('list', 'tagger-completion-' + this._id);
            } else {
                this._new_input_tag.removeAttribute('list');
            }
        },
        // --------------------------------------------------------------------------------------
        _build_completion: function(list) {
            this._completion.innerHTML = '';
            this._last_completion = list;
            if (list.length) {
                var id = 'tagger-completion-' + this._id;
                var datalist = create('datalist', {id: id}, list.map(function(tag) {
                    return ['option', {}, [tag]];
                }));
                this._completion.appendChild(datalist);
            }
        },
        // --------------------------------------------------------------------------------------
        complete: function(value) {
            if (this._settings.completion) {
                var list = this._settings.completion.list;
                if (typeof list === 'function') {
                    var ret = list(value);
                    if (ret && typeof ret.then === 'function') {
                        ret.then(this._build_completion.bind(this));
                    } else if (ret instanceof Array) {
                        this._build_completion(ret);
                    }
                } else {
                    this._build_completion(list);
                }
            }
        },
        // --------------------------------------------------------------------------------------
        tags_from_input: function() {
            this._tags = this._input.value.split(/\s*,\s*/).filter(Boolean);
            this._tags.forEach(this._new_tag.bind(this));
        },
        // --------------------------------------------------------------------------------------
        _new_tag: function(name) {
            var close = ['a', {href: '#', 'class': 'close'}, ['\u00D7']];
            var label = ['span', {'class': 'label'}, [name]]
            var href = this._settings.link(name);
            var li;
            if (href === false) {
                li = create('li', {}, [['span', {}, [label, close]]]);
            } else {
                var a_atts = {href: href, target: '_black'};
                li = create('li', {}, [['a', a_atts, [label, close]]]);
            }
            this._ul.insertBefore(li, this._new_input_tag.parentNode);
        },
        // --------------------------------------------------------------------------------------
        add_tag: function(name) {
            if (!this._settings.allow_duplicates && this._tags.indexOf(name) !== -1) {
                return false;
            }
            this._new_tag(name)
            this._tags.push(name);
            this._input.value = this._tags.join(', ');
            return true;
        },
        // --------------------------------------------------------------------------------------
        remove_tag: function(close) {
            var li = close.closest('li');
            var name = li.querySelector('.label').innerText;
            this._ul.removeChild(li);
            this._tags = this._tags.filter(function(tag) {
                return name !== tag;
            });
            this._input.value = this._tags.join(', ');
        }
    };
    // ------------------------------------------------------------------------------------------
    return tagger;
  });

</script>
<script>
  var t1 = tagger(document.querySelector('[name="tags"]'), {
    allow_duplicates: false,
    allow_spaces: true
  });
</script>
{{-- Tags Input End --}}
@endsection