const choicesCustomCategories1 = new Choices(
    document.querySelector('.js-select1'), {
      callbackOnCreateTemplates: function(template) {
        let classNames = this.config.classNames;
        let itemSelectText = this.config.itemSelectText;
        return {
          choice: function(classNames, data) {
            return template(`<div class="${String(classNames.item)} ${String(classNames.itemChoice)} ${String(data.disabled ? classNames.itemDisabled : classNames.itemSelectable)}"
                              data-select-text="${String(itemSelectText)}"
                              data-choice ${String(data.disabled ? 'data-choice-disabled aria-disabled=true' : 'data-choice-selectable')}
                              data-id="${String(data.id)}"
                              data-value="${String(data.value)}"
                              data-label="${String(data.label)}"
                              ${String(data.groupId > 0 ? 'role="treeitem"' : 'role="option"')}>
                                  <img src="${String(data.value)}" alt="">
                                  ${String(data.label)}
                              </div>`)
          }
        }
      }
    });

    const choicesCustomCategories2 = new Choices(
      document.querySelector('.js-select2'), {
        callbackOnCreateTemplates: function(template) {
          let classNames = this.config.classNames;
          let itemSelectText = this.config.itemSelectText;
          return {
            choice: function(classNames, data) {
              return template(`<div class="${String(classNames.item)} ${String(classNames.itemChoice)} ${String(data.disabled ? classNames.itemDisabled : classNames.itemSelectable)}"
                                data-select-text="${String(itemSelectText)}"
                                data-choice ${String(data.disabled ? 'data-choice-disabled aria-disabled=true' : 'data-choice-selectable')}
                                data-id="${String(data.id)}"
                                data-value="${String(data.value)}"
                                data-label="${String(data.label)}"
                                ${String(data.groupId > 0 ? 'role="treeitem"' : 'role="option"')}>
                                    <img src="${String(data.value)}" alt="">
                                    ${String(data.label)}
                                </div>`)
            }
          }
        }
      });

$('.js-select1').change(function(){
  var choice2 = $('.select2 .choices__list .choices__item').not('[aria-selected="true"]');
  var choice3 = $('.select1 .choices__item.choices__item--choice.choices__item--selectable.is-highlighted');
  let select1 = choice3.find('img').attr('src');
  choice2.each(function(k, v){
    let allOption = $(v);
    let select2 = $(v).find('img').attr('src');
    if(select1 == select2){
      $(this).addClass("disabledbutton");
    }else {
      allOption.removeClass("disabledbutton");
    }
  });
});

$('.js-select2').change(function(){
  var choice1 = $('.select1 .choices__list .choices__item').not('[aria-selected="true"]');
  var choice2 = $('.select2 .choices__item.choices__item--choice.choices__item--selectable.is-highlighted');
  let select1 = choice2.find('img').attr('src');
  choice1.each(function(k, v){
    let allOption1 = $(v);
    let select3 = $(v).find('img').attr('src');
    if(select1 == select3){
      $(this).addClass("disabledbutton");
    }else {
      allOption1.removeClass("disabledbutton");
    }
  });
});