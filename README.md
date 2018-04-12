# LangPHP
Class to make multilanguage of web-site as easy as possible. PHP version.
You can find JS version of this class at https://github.com/balovbohdan/LangJS

# Examples
## 1. Simple example
You can use this language class directly (see code below). But it is better to make subclasses of this class for different logical blocks of the web-site (see next example).

[example here]

For this example you have to organize this folders/files structure:

```inline
app
├── ...
├── lang                            # Root folder for logical language blocks.
|   ├── ...
|   ├── user-profile                # Root folder for user profile page language files.
|   |   ├── [some_lang_code].json
|   |   ├── pl.json                 # Language file for Polish version of the page.
|   |   ├── uk.json                 # Language file for English version of the page.
|   |   ├── [some_lang_code].json
|   |   └── ...
|   └── ...
└── ...
```

## 2. Better usage
It is better when you make subclasses of the main language class for the different logical blocks of your web-site. For instance: user profile, news, articles, admin page, etc.

[example here]

Do note that UserProfileLang class is singletone; it means that it is possible to make only one instance of it (when you creating instance more than one time you get the same instance). So now we can rewrite code from the first example. As you can see it looks pretty good and laconically.

[example here]

This version of making language instance much more safe. Using classes of the certain logical web-site blocks you can't make mistake in the paths to language data folders. (And you don't need type the same paths again and again!)
