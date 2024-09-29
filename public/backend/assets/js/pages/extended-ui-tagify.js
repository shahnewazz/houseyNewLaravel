(function($) {
    'use strict';

    const tagifyBasicEl = document.querySelector('#tagifyBasic');
    const TagifyBasic = new Tagify(tagifyBasicEl);

    
    const tagifyReadonlyEl = document.querySelector('#tagifyReadonly');
    const TagifyReadonly = new Tagify(tagifyReadonlyEl);


  // Custom list & inline suggestion
  //------------------------------------------------------
  const TagifyCustomInlineSuggestionEl = document.querySelector('#TagifyCustomInlineSuggestion');
  const TagifyCustomListSuggestionEl = document.querySelector('#TagifyCustomListSuggestion');

  const whitelist = [
    'Bash',
    'Bourne Shell',
    'C',
    'C++',
    'C#',
    'Clojure',
    'Cobol',
    'Crystal',
    'D',
    'Dart',
    'Delphi/Object Pascal',
    'Elixir',
    'Elm',
    'Erlang',
    'F#',
    'Fortran',
    'Go',
    'Groovy',
    'Haskell',
    'HTML',
    'Java',
    'JavaScript',
    'Julia',
    'Kotlin',
    'Lisp',
    'Lua',
    'MATLAB',
    'Objective-C',
    'Pascal',
    'Perl',
    'PHP',
    'Prolog',
    'Python',
    'R',
    'Ruby',
    'Rust',
    'Scala',
    'Scheme',
    'Shell',
    'SQL',
    'Swift',
    'TypeScript',
    'Visual Basic',
    'Wolfram'
];

  // Inline
  let TagifyCustomInlineSuggestion = new Tagify(TagifyCustomInlineSuggestionEl, {
    whitelist: whitelist,
    maxTags: 10,
    dropdown: {
      maxItems: 20,
      classname: 'tags-inline',
      enabled: 0,
      closeOnSelect: false
    }
  });
  // List
  let TagifyCustomListSuggestion = new Tagify(TagifyCustomListSuggestionEl, {
    whitelist: whitelist,
    maxTags: 10,
    dropdown: {
      maxItems: 20,
      classname: '',
      enabled: 0,
      closeOnSelect: false
    }
  });

  }(jQuery) )