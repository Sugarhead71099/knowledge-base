let panelTempId = 0;
const tabs = [];
const submenus = [];
const protocols = [];
const editedTabs = [];
const editedMenus = [];
const editedProtocols = [];
let newFolderPresent = false;
let currentFolderLink = '';
let currentFolderLinkID = '';


function toTitleCase(str) {
return str.replace(/\w\S*/g, text => text.charAt(0).toUpperCase() + text.substr(1).toLowerCase());
}

function toCamelCase(str) {
let camelCaseString = toTitleCase(str.toLowerCase()).replace(/ +/g, '');
camelCaseString = camelCaseString.charAt(0).toLowerCase() + camelCaseString.substring(1);
return camelCaseString;
}

// function toReferenceName(str) {
//   const referenceName = toCamelCase(str);
//   return $.trim(referenceName.replace(/f/g, ''));
// }

function removeMainTabSpecialChars(str) {
return $.trim(str
  .replace(/#/g, '')
  .replace(/%/g, '')
  .replace(/\\/g, '')
  .replace(/'/g, '')
  .replace(/\//g, '')
  .replace(/\?/g, '')
  .replace(/`/g, '')
  .replace(/~/g, '')
  .replace(/\(/g, '')
  .replace(/\)/g, ''));
}

function removeSubmenuSpecialChars(str) {
return $.trim(str
  .replace(/\\/g, '')
  .replace(/'/g, ''));
}

function removeProtocolSpecialChars(str) {
return $.trim(str
  .replace(/#/g, '')
  .replace(/%/g, '')
  .replace(/\\/g, '')
  .replace(/\?/g, '')
  .replace(/\//g, ''));
}

function removeAllSpecialChars(str) {
return $.trim(str
  .replace(/!/g, '')
  .replace(/@/g, '')
  .replace(/#/g, '')
  .replace(/\$/g, '')
  .replace(/%/g, '')
  .replace(/\^/g, '')
  .replace(/&/g, '')
  .replace(/\*/g, '')
  .replace(/\(/g, '')
  .replace(/\)/g, '')
  .replace(/\+/g, '')
  .replace(/=/g, '')
  .replace(/`/g, '')
  .replace(/~/g, '')
  .replace(/\./g, '')
  .replace(/,/g, '')
  .replace(/;/g, '')
  .replace(/:/g, '')
  .replace(/\//g, '')
  .replace(/"/g, '')
  .replace(/'/g, '')
  .replace(/\\/g, '')
  .replace(/</g, '')
  .replace(/>/g, '')
  .replace(/\?/g, '')
  .replace(/\|/g, '')
  .replace(/\[/g, '')
  .replace(/\]/g, '')
  .replace(/\{/g, '')
  .replace(/\}/g, ''));
}

function parenthesesWordToLowerCase(str) {
if (str.indexOf('(') >= 0) {
  const parenthesesIndex = str.indexOf('(');
  return str.substring(0, parenthesesIndex + 1) +
         str.substring(parenthesesIndex + 1, parenthesesIndex + 2).toLowerCase() +
         str.substring(parenthesesIndex + 2);
}
return str;
}

/* Given the element and class to compare against -
* return true if class applied to element -
 * otherwise returns false */
function hasClass(element, cls) {
return (` ${element.className} `).indexOf(` ${cls} `) > -1;
}

function is_array(obj) {
if (obj.constructor.toString().indexOf('Array') == -1) {
  return false;
}
return true;
}

function strip_tags(input) {
if(input) {
  if(!is_array(input)) {
    input = input.replace(/<\/?[^>]+(>|$)/g, '');
  }
else {
  const i = input.length;
  const newInput = [];
  while(i--) {
    input[i] = input[i].replace(/<\/?[^>]+(>|$)/g, '');
  }
}
return input;
}
return false;
}

function htmlentities(str) {
return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// Copies a string to the clipboard. Must be called from within an
// event handler such as click. May return false if it failed, but
// this is not always possible. Browser support for Chrome 43+,
// Firefox 42+, Safari 10+, Edge and IE 10+.
// IE: The clipboard feature may be disabled by an administrator. By
// default a prompt is shown the first time the clipboard is
// used (per session).
function copyToClipboard(text) {
$('#custom-width-modal .modal-body').append(`<textarea id="quickCopy00000" style="opacity: 0 !important;">${text}</textarea>`);

const tempval = eval($('#quickCopy00000'));
tempval.focus();
tempval.select();
document.execCommand('copy');

$('#quickCopy00000').remove();
}

function createRootFolder(elem_id, text) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/createRootFolder.php',
  data: { elem_id, text },
  datatype: 'text',
});
}

function createNewMainTab(tabName) {
const formattedTabName = removeAllSpecialChars(tabName);
createRootFolder(`${formattedTabName}Root`, tabName);
$.ajax({
  type: 'POST',
  url: 'helperFunctions/newMainTab.php',
  data: {
    data: `<?php
if(!session_id())
session_start();
include_once('kbFunctions.php');
$belongs_to = ucfirst(addSpacingByCamelCase(basename(__FILE__, '.php')));
$accordionName = 'accordion-' . str_replace($badChars, '', basename(__FILE__, '.php'));
$root_folder = basename(__FILE__, '.php') . 'Root';


$stmt = $mysqli->prepare("SELECT * FROM knowledge_base_tree_hierarchy WHERE root_folder = ?");
$stmt->bind_param("s", $root_folder);
$stmt->execute();
$folders = $stmt->get_result();
?>

<div class="page-container" id="${formattedTabName}Page">

<div class="card-box" oncontextmenu="return true;">
<h4 class="text-dark header-title m-t-0 m-b-30">${formattedTabName}</h4>
<input class="search-input form-control pull-right col-md-3" placeholder="Search..."></input>
<div id="${formattedTabName}Tree" class="jstree jstree-4 jstree-default jstree-closed" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j4_1" aria-busy="false">
<ul class="jstree-container-ul jstree-children jstree-wholerow-ul jstree-no-dots" role="group">



</ul>
</div>
<div class="submenuSearchResults container" style="margin-top: 30px;"></div>
<div class="protocolSearchResults container" style="margin-top: 30px;"></div>
</div>

<script>
function customMenu(node) {
  const items = {
    item1: {
      label: 'Create',
      action() {
        const position = 'inside';
        const parent = node;
        const newNode = { state: { opened: true, disabled: false, selected: true }, data: 'New Node' };
        $('#${formattedTabName}Tree').jstree('create_node', parent, newNode, position, function createNode(currentNode) {
          this.edit(currentNode);
        }, true);
      },
    },
    item2: {
      label: 'Rename',
      action() {
        $('#${formattedTabName}Tree').jstree('edit', node);
      },
    },
    item3: {
      label: 'Delete',
      action() {
        $('#${formattedTabName}Tree').jstree('delete_node', node);
      },
    },
  };

  if (node.type === '#') {
    delete items.item2;
    delete items.item3;
  } else if (node.type === 'level_3') { delete items.item1; }

  return items;
}

$('#${formattedTabName}Tree').jstree({
  core: {
    animation: 250,
    check_callback: true,
    themes: {
      responsive: true,
    },
    data: [<?php
if($folders->num_rows > 0)
while($folder = $folders->fetch_assoc())
echo aposreg;{ "id" : "aposreg; . $folder["elem_id"] . aposreg;", "parent" : "aposreg; . $folder["parent"] . aposreg;", "text" : "aposreg; . $folder["text"] . aposreg;", "icon" : "aposreg; . $folder["icon"] . aposreg;", "state" : { "opened" : aposreg; . $folder["opened"] . aposreg;, "disabled" : aposreg; . $folder["disabled"] . aposreg;, "selected" : aposreg; . $folder["selected"] . aposreg; }, "li_attr" : {}, "a_attr" : {}, "type" : "aposreg; . $folder["type"] . aposreg;", },aposreg;;
?>],
  },
  contextmenu: {
    items: customMenu,
  },
  search: {
    case_insensitive: true,
    show_only_matches: true,
  },
  types: {
    '#': {
      icon: 'fa fa-folder',
      max_children: 1000,
      max_depth: 4,
      valid_children: ['default', 'level_1', 'level_2'],
    },
    level_1: {
      icon: 'fa fa-folder',
      max_children: 1000,
      max_depth: 2,
      valid_children: ['default', 'level_2'],
    },
    level_2: {
      icon: 'fa fa-folder',
      max_children: 1000,
      max_depth: 1,
      valid_children: ['default', 'level_3'],
    },
    level_3: {
      icon: 'fa fa-ils',
      max_children: 0,
      max_depth: 0,
      valid_children: [],
    },
    file: {
      icon: 'fa fa-file',
      valid_children: [],
    },
    default: {
      icon: 'fa fa-lock',
      max_children: 1000,
      max_depth: 3,
      valid_children: ['default', 'level_3'],
    },
  },
  plugins: ['contextmenu', 'dnd', 'search', 'state', 'types', 'wholerow'],
});

$('#${formattedTabName}Page .search-input').keyup(function searchDatabase() {
  const searchString = $(this).val();
  $('#${formattedTabName}Tree').jstree('search', searchString);

  if ($.trim(searchString)) {
    $.ajax({
      type: 'POST',
      url: 'helperFunctions/submenuSearch.php',
      data: { searchString },
      datatype: 'text',
      success(data) {
        $('#${formattedTabName}Page .submenuSearchResults').html(data);
      },
    });

    $.ajax({
      type: 'POST',
      url: 'helperFunctions/protocolSearch.php',
      data: { searchString },
      datatype: 'text',
      success(data) {
        $('#${formattedTabName}Page .protocolSearchResults').html(data);
      },
    });
  } else {
    $('#${formattedTabName}Page .submenuSearchResults').empty();
    $('#${formattedTabName}Page .protocolSearchResults').empty();
  }
});

// $('#${formattedTabName}Tree').jstree(true).settings.contextmenu.items = {};
// $('#${formattedTabName}Tree').jstree(true).refresh();

<&sol;script>

<?php $folders->close(); ?>

</div><div id="endOf${formattedTabName}Page"></div>`,
    tabName,
  },
  datatype: 'text',
});
}

function createNewSubmenu(menuName) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/newSubmenu.php',
  data: { menuName, belongs_to: currentFolderLinkID.substring(currentFolderLinkID.lastIndexOf('_') + 1) },
  datatype: 'text',
});
}

function createNewProtocol(protocolName, parentMenu, submenuBelongsTo) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/newProtocol.php',
  data: { protocolName, parentMenu, submenuBelongsTo },
  datatype: 'text',
});
}

function postCreateNewElementData() {
const allNewMainTabs = [...document.querySelectorAll('.new-main-tab')];
allNewMainTabs.forEach((newMainTab) => {
  const currentTabText = toCamelCase($.trim(newMainTab
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .innerText));

  createNewMainTab(removeMainTabSpecialChars(currentTabText));
});

const allNewSubmenus = [...document.querySelectorAll('.new-submenu')];
allNewSubmenus.forEach((newSubmenu) => {
  const currentMenuText = $.trim(newSubmenu
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .innerText);

  createNewSubmenu(removeSubmenuSpecialChars(currentMenuText));
});

const allNewProtocols = [...document.querySelectorAll('.new-protocol')];
allNewProtocols.forEach((newProtocol) => {
  const currentProtocolText = $.trim(newProtocol.innerText);
  const currentMenuBody = $.trim(newProtocol
    .parentElement
    .parentElement
    .previousElementSibling
    .firstElementChild
    .firstElementChild
    .innerText);

  const formattedProtocol = removeProtocolSpecialChars(currentProtocolText);
  const formattedSubmenu = removeSubmenuSpecialChars(currentMenuBody);
  createNewProtocol(formattedProtocol,
                    formattedSubmenu,
                    parseInt(currentFolderLinkID
                      .substring(currentFolderLinkID
                        .lastIndexOf('_') + 1)));
});
}

function changeMainTab(oldName, newName, old_elem_id, new_elem_id) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/changeMainTab.php',
  data: { oldName, newName, old_elem_id, new_elem_id },
  datatype: 'text',
});
}

function changeSubmenu(oldName, newName, belongs_to) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/changeSubmenu.php',
  data: { oldName, newName, belongs_to, elem_id: currentFolderLinkID },
  datatype: 'text',
});
}

function changeProtocol(oldName, newName, parentMenu, submenuBelongsTo) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/changeProtocol.php',
  data: {
    oldName, newName, parentMenu, submenuBelongsTo, elem_id: currentFolderLinkID
  },
  datatype: 'text',
});
}

function postEditElementData() {
editedTabs.forEach((tab) => {
  let newTabText = tab
    .element
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .innerText;

  if (newTabText !== tab.oldText) {
    const oldTabText = toCamelCase($.trim(tab.oldText));
    newTabText = removeMainTabSpecialChars(toCamelCase($.trim(newTabText)));
    const old_elem_id = removeAllSpecialChars(oldTabText) + 'Root';
    const new_elem_id = removeAllSpecialChars(newTabText) + 'Root';
    changeMainTab(oldTabText, newTabText, old_elem_id, new_elem_id);
  }
});

editedMenus.forEach((menu) => {
  let newMenuText = menu
    .element
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .innerText;
  if (newMenuText !== menu.oldText) {
    const oldMenuText = $.trim(menu.oldText);
    newMenuText = removeSubmenuSpecialChars($.trim(newMenuText));
    let belongsTo = menu
      .element
      .firstElementChild
      .firstElementChild
      .firstElementChild
      .getAttribute('data-parent');
      belongsTo = parseInt(belongsTo.substring(belongsTo.lastIndexOf('_') + 1));
    changeSubmenu(oldMenuText, newMenuText, belongsTo/*menu.parentTab*/);
  }
});

editedProtocols.forEach((protocol) => {
  if (protocol.element.innerText !== protocol.oldText) {
    const oldProtocolText = $.trim(protocol.oldText);
    const newProtocolText = removeProtocolSpecialChars($.trim(protocol.element.innerText));
    changeProtocol(oldProtocolText,
      newProtocolText,
      protocol.parentMenu,
      parseInt(currentFolderLinkID
                      .substring(currentFolderLinkID
                        .lastIndexOf('_') + 1)));
  }
});
}

function postOutputTabData() {
document.getElementById('protocolForm').submit();
}

function deleteMainTab(tabName, elem_id) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/deleteMainTab.php',
  data: { tabName, elem_id },
  datatype: 'text',
});
}

function deleteSubmenu(menuName, belongs_to) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/deleteSubmenu.php',
  data: { menuName, elem_id: currentFolderLinkID, belongs_to/* , parentTab: parentTab */ },
  datatype: 'text',
});
}

function deleteProtocol(protocolName, parentMenu, submenuBelongsTo) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/deleteProtocol.php',
  data: { protocolName, submenuBelongsTo, parentMenu, elem_id: currentFolderLinkID /* , parentTab: parentTab, parentMenu: parentMenu */ },
  datatype: 'text',
});
}

function mainTabEdit() {
$('#kBMainTabs li').addClass('old-main-tab');
$('#kBMainTabs li').click(function triggerEdited() {
  $(this).unbind('click');
  $(this).removeClass('old-main-tab').addClass('edit-main-tab');
});
$('#kBMainTabs li').dblclick(function enableMainTabEdit() {
  const textElement = this.firstElementChild.firstElementChild.firstElementChild;
  editedTabs.push({ element: this, oldText: textElement.innerText });
  $(textElement).attr('contenteditable', 'true').attr('style', "font-family: 'Source Sans Pro', 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-weight: 600 !important; font-size: 1rem !important; text-align: center !important;");
  textElement.focus();
  const thisTab = this;
  const thisTabText = textElement.innerText;

  $(document).on('focusout', this.firstElementChild.firstElementChild.firstElementChild, () => {
    const text = $.trim(thisTab
      .firstElementChild
      .firstElementChild
      .firstElementChild
      .innerText);
    if (!text) {
      let confirmButtonText = '';
      $('#sa-warning').trigger('click');
      $('.sweet-alert').unbind('mouseover').mouseover(function findConfirmButtonText() {
        confirmButtonText = $(this).find('.confirm').text();
      });

      $('.confirm').unbind('mousedown').mousedown(function confirmAction() {
        if (confirmButtonText === 'Yes, delete it!') {
          $(document).unbind('focusout');
          deleteMainTab(thisTabText, removeAllSpecialChars(removeMainTabSpecialChars(toCamelCase(thisTabText))) + 'Root');
          editedTabs.splice(editedTabs.length - 1, 1);
          $(`#${toCamelCase(thisTabText)}`).remove();
          $(thisTab).remove();
        } else if (confirmButtonText === 'OK') {
          $('.sweet-alert').unbind('mouseover');
          $(this).unbind('mousedown');
          $('.sweet-alert').mouseup(function removeSweetAlert() {
            $(this).unbind('mouseup');
            sweetAlert.close();
            $(this).remove();
            $('.sweet-overlay').remove();
          });
        }
      });

      $('.cancel').unbind('click').click(function cancelEdits() {
        $(document).unbind('focusout');
        textElement.innerText = thisTabText;
        $(this).unbind('click');
        sweetAlert.close();
      });
    }
  });
});
}

function submenuEdit() {
$('.panel').addClass('old-submenu');
$('.panel').unbind('click').click(function triggerEdited() {
  $(this).unbind('click');
  $(this).removeClass('old-submenu').addClass('edit-submenu');
});
$('.panel-heading').unbind('dblclick').dblclick(function enableSubmenuEdit() {
  editedMenus.push({
    element: this.parentElement,
    oldText: this.firstElementChild.firstElementChild.innerText,
    parentTab: this.parentElement.parentElement.parentElement.parentElement.parentElement.id,
  });
  $(this.firstElementChild.firstElementChild).attr('contenteditable', 'true').attr('style', 'font-family: inherit !important; font-weight: 600 !important; line-height: 1.1 !important; font-size: 1.25rem !important; letter-spacing: 0.03em !important;');
  this.focus();
  const thisMenu = this;
  const thisMenuBody = this.firstElementChild.firstElementChild.href.substring(this.firstElementChild.firstElementChild.href.indexOf('#') + 1);
  const thisMenuText = this.firstElementChild.firstElementChild.innerText;

  $(document).on('focusout', thisMenu.firstElementChild.firstElementChild, () => {
    const text = $.trim(thisMenu.firstElementChild.firstElementChild.innerText);
    if (!text) {
      let confirmButtonText = '';
      $('#sa-warning').trigger('click');
      $('.sweet-alert').unbind('mouseover').mouseover(function findConfirmButtonText() {
        confirmButtonText = $(this).find('.confirm').text();
      });

      $('.confirm').unbind('mousedown').mousedown(function confirmAction() {
        if (confirmButtonText === 'Yes, delete it!') {
          $(document).unbind('focusout');
          let belongsTo = parseInt(thisMenu
              .firstElementChild
              .firstElementChild
              .getAttribute('data-parent')
              .substring(thisMenu
              .firstElementChild
              .firstElementChild
              .getAttribute('data-parent')
              .lastIndexOf('_') + 1));
          deleteSubmenu(thisMenuText, belongsTo);
          // console.log(editedMenus[editedMenus.length - 1]);
          editedMenus.splice(editedMenus.length - 1, 1);
          $(`#${thisMenuBody}`).remove();
          $(thisMenu).remove();
        } else if (confirmButtonText === 'OK') {
          $('.sweet-alert').unbind('mouseover');
          $(this).unbind('mousedown');
          $('.sweet-alert').mouseup(function removeSweetAlert() {
            $(this).unbind('mouseup');
            sweetAlert.close();
            $(this).remove();
            $('.sweet-overlay').remove();
          });
        }
      });

      $('.cancel').unbind('click').click(function cancelEdits() {
        $(document).unbind('focusout');
        thisMenu.firstElementChild.firstElementChild.innerText = thisMenuText;
        $(this).unbind('click');
        sweetAlert.close();
      });
    }
  });
});
}

function protocolEdit() {
$('.protocol').unbind('click');
$('.protocol').addClass('old-protocol');
$('.protocol').click(function triggerEdited() {
  $(this).unbind('click');
  $(this).removeClass('old-protocol').addClass('edit-protocol');
});
$('.protocol').dblclick(function enableProtocolEdit() {
  let protocolMenuReference = $.trim($(this)
    .parent()
    .parent()
    .prev()
    .first()
    .first()
    .text());
  protocolMenuReference = parenthesesWordToLowerCase(protocolMenuReference);
  editedProtocols.push({
    element: this,
    oldText: this.innerText,
    parentMenu: protocolMenuReference,
    parentTab: this
      .parentElement
      .parentElement
      .parentElement
      .parentElement
      .parentElement
      .parentElement
      .parentElement
      .id,
  });
  $(this).attr('contenteditable', 'true').attr('style', "font-family: -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important; font-size: 1rem !important; font-weight: normal !important; line-height: 1.5 !important;");
  this.focus();
  const thisProtocol = this;
  const thisProtocolText = this.innerText;

  $(document).on('focusout', this, () => {
    const text = $.trim(thisProtocol.innerText);
    if (!text) {
      let confirmButtonText = '';
      $('#sa-warning').trigger('click');
      $('.sweet-alert').unbind('mouseover').mouseover(function findConfirmButtonText() {
        confirmButtonText = $(this).find('.confirm').text();
      });

      $('.confirm').unbind('mousedown').mousedown(function confirmAction() {
        if (confirmButtonText === 'Yes, delete it!') {
          $(document).unbind('focusout');
          deleteProtocol(thisProtocolText.toLowerCase(),
            protocolMenuReference,
            parseInt(currentFolderLinkID
                      .substring(currentFolderLinkID
                        .lastIndexOf('_') + 1)));
          editedProtocols.splice(editedProtocols.length - 1, 1);
          $(thisProtocol).remove();
        } else if (confirmButtonText === 'OK') {
          $('.sweet-alert').unbind('mouseover');
          $(this).unbind('mousedown');
          $('.sweet-alert').mouseup(function removeSweetAlert() {
            $('.sweet-alert').unbind('mouseup');
            sweetAlert.close();
            $(this).remove();
            $('.sweet-overlay').remove();
          });
        }
      });

      $('.cancel').unbind('click').click(function cancelEdits() {
        $(document).unbind('focusout');
        thisProtocol.innerText = thisProtocolText;
        $(this).unbind('click');
        sweetAlert.close();
      });
    }
  });
});
}

function updateMainTabs() {
$('#addMainTab').unbind('click').click(function updateNewTabs() {
  $(`<li class="new-main-tab" style="">
<a href="javascript:void(0)" data-toggle="tab" aria-expanded="false">
<font>
<font contenteditable style="font-family: 'Source Sans Pro', 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-weight: 600 !important; font-size: 1rem !important; text-align: center !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
</font>
</a>
</li>`).insertBefore($(this));

  this.previousElementSibling.firstElementChild.firstElementChild.firstElementChild.focus();

  $('.new-main-tab').unbind('focusout').focusout(function formatMainTabText() {
    const tabText = this.firstElementChild.firstElementChild.firstElementChild.innerText;
    this.firstElementChild.firstElementChild.firstElementChild.innerText = $.trim(tabText);
    const text = $.trim($(this).first().first().first()
      .text());
    if (!text) { $(this).remove(); }
  });
});
}

function addMainTabs() {
$('#addMainTab').remove();
$('#kBMainTabs').append('<li id="addMainTab" class style><a href="javascript:void(0)"><font><i class="ion-android-add"></i></font></a></li>');

updateMainTabs();
}

function updateProtocols() {
$('.add-protocol').unbind('click').click(function updateNewProtocols() {
  $('<a class="col-lg-4 col-md-6 col-sm-12 col-xs-12 protocol text-center new-protocol" href="javascript:void(0)" contenteditable style="font-family: -apple-system, system-ui, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif !important; font-size: 1rem !important; font-weight: normal !important; line-height: 1.5 !important;"></a>').insertBefore(this);
  this.previousElementSibling.focus();
});

$(document).on('focusout', '.new-protocol', function formatProtocolText() {
  const text = $.trim($(this).text());
  if (!text) { $(this).remove(); }
});
}

function updateSubmenus() {
$('.add-panel').unbind('click').click(function updateNewSubmenus() {
  $(`<div class="panel panel-default new-submenu">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#${$(this).parent().parent().parent()
.parent()
.attr('id')}" href="#${panelTempId}" aria-expanded="false" class="collapsed" contenteditable style="font-family: inherit !important; font-weight: 600 !important; line-height: 1.1 !important; font-size: 1.25rem !important; letter-spacing: 0.03em !important;"></a>
</h4>
</div>
<div id="${panelTempId}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
<div class="panel-body text-justify">
<a class="col-lg-3 col-md-6 col-sm-12 col-xs-12 protocol add-protocol" href="javascript:void(0)"><i class="ion-android-add"></i></a>
</div>
</div>
</div>`).insertBefore($(this).parent().parent().parent());
  setTimeout(() => { $('.ion-android-add').addClass('grow'); }, 100);
  updateProtocols();
  this
    .parentElement
    .parentElement
    .parentElement
    .previousElementSibling
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .focus();
  panelTempId += 1;

  $('.new-submenu').unbind('focusout').focusout(function formatSubmenuText() {
    const text = $.trim($(this).first().first().first()
      .text());
    if (!text) { $(this).remove(); }
  });
});
}

function addSubmenus() {
const allPanelGroups = [...document.querySelectorAll('.panel-group')];
allPanelGroups.forEach((panelGroup) => {
  $(panelGroup).find('.addSubmenu').remove();
  $(panelGroup).append(`<div class="addSubmenu panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion-${$(panelGroup).attr('id')}" href="javascript:void(0)" aria-expanded="false" class="collapsed add-panel"><i class="submenuIon ion-android-add"></i></a>
</h4>
</div>
</div>`);
});

updateSubmenus();
}

function addProtocols() {
const allPanelBodies = [...document.querySelectorAll('.panel-body')];
allPanelBodies.forEach((panelBody) => {
  $(panelBody).append('<a class="col-lg-4 col-md-6 col-sm-12 col-xs-12 protocol text-center add-protocol" href="javascript:void(0)"><i class="ion-android-add"></i></a>');
});

updateProtocols();
}

function enableProtocolFunctionality(originFilepath) {
$('.protocol').unbind('click').click(function getProtocolContents(event) {
  event.preventDefault();

  $('#toggleFullWidthModal').click();
  $('.modal-backdrop').toggleClass('reveal');

  const contentBodyId = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .attr('id');
  const protocolMenuReference = parenthesesWordToLowerCase(toCamelCase($.trim($(this)
    .parent()
    .parent()
    .prev()
    .first()
    .first()
    .text()
    .toLowerCase())));
  parenthesesWordToLowerCase(protocolMenuReference);

  let protocol = $(this).text().toLowerCase();
  let referenceName = toCamelCase(protocol);
  referenceName = parenthesesWordToLowerCase(referenceName);
  referenceName = removeAllSpecialChars(referenceName);
  protocol = toCamelCase(removeProtocolSpecialChars(protocol));

  $.post(`${originFilepath}/${protocolMenuReference}/${protocol}.php`, (data) => {
    $('#custom-width-modal .modal-body').html(data);
    $('#custom-width-modal .modal-body').append(`<form id="protocolForm" method="POST" action="EditableUI.php" style="display: none;">
<input id="protocolData" name="protocolData" type="text">
<input id="parentTab" name="parentTab" type="text">
<input id="parentMenu" name="parentMenu" type="text">
<input id="protocolName" name="protocolName" type="text">
<input id="referenceName" name="referenceName" type="text">
<input id="elemID" name="elemID" type="text">
</form>`);
    $('#protocolData').val(data);
    $('#parentTab').val(contentBodyId);
    $('#parentMenu').val(protocolMenuReference);
    $('#protocolName').val(protocol);
    $('#referenceName').val(referenceName);
    $('#elemID').val(currentFolderLinkID);
  });

  $('#changeProtocol').unbind('click').click(() => {
    postOutputTabData();
  });

  document.getElementById('protocolWindow').href = this.href;
  $('#protocolWindow').unbind('click').click(function openWindowedProtocol(e) {
    e.preventDefault();
    window.open(this.href, protocol, `toolbar=yes,scrollbars=yes,resizable=yes,left=100,top=25,width=${window.screen.width - 100},height=${window.screen.height - 100}`);
  });

  document.getElementById('sopLink').href = this.href.replace(/false/g, 'true');
  $('#sopLink').unbind('click').click(function sopLinkToClipboard(e) {
    e.preventDefault();
    copyToClipboard(this.href);
    $.Notification.notify('success', 'bottom left', '', 'SOP Link Copied To Clipboard');
  });
});
}

function updateRootFolderContents(root_folder) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/updateRootFolderContents.php',
  data: { root_folder },
  datatype: 'json',
  success(data) {
  // console.log(JSON.parse(data));
    $(`#${root_folder}`).jstree(true).settings.core.data = JSON.parse(data);
    $(`#${root_folder}`).jstree(true).refresh();
  },
});
}


// Creates new folder id utilizing the tree hierarchy
function constructFolderId(node, str) {
let id = '';
for (let index = node.parents.length - 1; index >= 0; index -= 1) {
  id += node.parents[index] === '#' ? '' : `${node.parents[index].substring(node.parents[index].lastIndexOf('-') + 1)}-`;
}
return id + str;
}

function arrayToObject(array) {
const object = {};
for (let i = 0; i < array.length; i += 1) { object[i] = array[i]; }

return object;
}

function createFolder(node) {
// console.log(node);
// console.log(constructFolderId(node, toCamelCase(removeAllSpecialChars(node.text))));
// console.log(node.parent);
// console.log(node.text);
// console.log(node.parents[node.parents.length - 2]);
let folderLevel = '';
switch (node.parents.length - 1) {
  case 1: folderLevel = 'level_1'; break;
  case 2: folderLevel = 'level_2'; break;
  case 3: folderLevel = 'level_3'; break;
  default: folderLevel = 'level unrecognized'; break;
}

$.ajax({
  type: 'POST',
  url: 'helperFunctions/createFolder.php',
  data: {
    elem_id: toCamelCase(removeAllSpecialChars(node.text)), parent: node.parent, text: node.text, icon: (node.parents.length - 1 === 3 ? 'fa fa-ils' : 'fa fa-folder'), type: folderLevel, root_folder: node.parents[node.parents.length - 2], submenu_request_file: (node.parents.length - 1 === 3 ? 1 : 0), allParents: JSON.stringify(arrayToObject(node.parents)), fileData: `<?php
include_once("../../../../../kbFunctions.php");
include_once("../../../../../../../config.inc.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if($mysqli->connect_errno) {
printf("Connection failed: %s", $mysqli->connect_error);
exit();
}
$parentLink = basename(__FILE__, ".php");
$belongs_to = substr($parentLink, strrpos($parentLink, "_") + 1);
$accordionName = "accordion-" . str_replace($badChars, "", $parentLink);
include_once("../../../../../buildMainTabMenus.php");
$mysqli->close();`,
  },
  datatype: 'text',
});
setTimeout(() => { updateRootFolderContents(node.parents[node.parents.length - 2]); }, 125);
}

function renameFolder(elem_id, text) {
$.ajax({
  type: 'POST',
  url: 'helperFunctions/renameFolder.php',
  data: { elem_id, text },
  datatype: 'text',
});
}

function deleteFolder(elem_id, children, link_node) {
// const phpChildren = arrayToObject(children);
$.ajax({
  type: 'POST',
  url: 'helperFunctions/deleteFolder.php',
  data: { elem_id, link_node /*children: JSON.stringify(phpChildren)*/},
  datatype: 'text',
});
}

function refreshPage() {
window.location.reload();
}

// Pass through the element containing the data you want to be parsed to a pdf, along with the name you want the parsed pdf to have
function convertToPDF(dataContainerElementReference, fileTitle) {
let newDataContainer = dataContainerElementReference;
$('newDataContainer *').removeAttr('style');

const pdf = new jsPDF('p', 'pt', 'letter')

// source can be HTML-formatted string, or a reference
// to an actual DOM element from which the text will be scraped.
, source = dataContainerElementReference[0]

// we support special element handlers. Register them with jQuery-style 
// ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
// There is no support for any other type of selectors 
// (class, of compound) at this time.
, specialElementHandlers = {
    // element with id of "bypass" - jQuery style selector
    '#bypassme': (element, renderer) => true // true = "handled elsewhere, bypass text extraction"
}

margins = {
  top: 0,
  bottom: 0,
  left: 40,
  width: 522
};
// all coords and widths are in jsPDF instance's declared units
// 'inches' in this case
pdf.fromHTML(
    source // HTML string or DOM elem ref.
    , margins.left // x coord
    , margins.top // y coord
    , {
        'width': margins.width // max width of content on PDF
        , 'elementHandlers': specialElementHandlers
    },
    (dispose) => {
      // dispose: object with X, Y of the last line add to the PDF 
      // this allow the insertion of new lines after html
      pdf.save(fileTitle + '.pdf');
    },
    margins
)
}

$('#extractToPDF').click(() => {
  convertToPDF(
    $('#custom-width-modal .modal-body'),
    toTitleCase($('#custom-width-modal .modal-body .protocol-title').text())
  )
});

$('.jstree').contextmenu(() => {
[...document.querySelectorAll('.jstree-default-contextmenu a')].forEach((option) => {
  if ($(option).text().indexOf('Create') >= 0) {
    $(option).click(() => {
      newFolderPresent = true;
      // createFolder();
    });
  }
});
});

$('.jstree').on('rename_node.jstree', (e, data) => {
if (newFolderPresent) {
  createFolder(data.node);
  newFolderPresent = false;
} else {
  renameFolder(data.node.id, data.node.text);
}
});

$('.jstree').on('delete_node.jstree', (e, data) => {
// console.log(data.node);
deleteFolder(data.node.id, data.node.children, data.node.type === "level_3" ? true : false);
});

// $(".jstree").on("select_node.jstree", function (e, data) {
//  console.log(data.node);
// });

$('.jstree').on('activate_node.jstree', function clicked(e, data) {
  if(data.node.type === 'level_3') {
    currentFolderLink = data;
  }
});

$('.jstree').on('click', '.jstree-anchor', function getSubmenuSections() {
if (hasClass(this.firstElementChild, 'fa-ils')) {
  const activeTab = document.getElementById('kBMainTabs').querySelector('li.active');
  const activePage = `${activeTab.firstElementChild.href.substring(activeTab.firstElementChild.href.indexOf('#') + 1)}Page`;
  const linkNode = this.innerText;

  const rootFolder = this
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .id.substring(0, this
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .id.indexOf('Root'));
    
    // console.log(this
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .id.substring(0, this
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .parentElement
    // .id.indexOf('Root')));

  const folderLevel1 = this
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .parentElement
    .id;
  const folderLevel2 = this.parentElement.parentElement.parentElement.id;
  const requestedFileFolder = this.parentElement.id;
  const requestedFile = `${requestedFileFolder}.php`;

  $.post(`mainTabs/${rootFolder}/${folderLevel1}/${folderLevel2}/${requestedFileFolder}/${requestedFile}`, (data) => {
    $(`#${activePage} .card-box`).css('display', 'none');
    $(`#${activePage}`).prepend(data);
    $(`#${activePage}`).prepend(`<h6 id="linkNodeDisplay">${linkNode}</h6>`);
    $('#kBMainTabs li').click(() => {
      $('#linkNodeDisplay').remove();
    });

    if ($('#editUI').text() === 'Submit') {
      submenuEdit();
      addSubmenus();

      $('#addSubmenu').animate({
        height: '20%',
      }, 650, function animateHeight() {
        $(this).css('height', '5%');
      });

      setTimeout(() => { $('.submenuIon').addClass('grow'); }, 200);
    }
    enableProtocolFunctionality(`mainTabs/${rootFolder}/${folderLevel1}/${folderLevel2}/${requestedFileFolder}`);

    $('#kBMainTabs li').click(() => {
      $('#kBMainTabs li').unbind('click');
      $(`#${activePage} .row`).remove();
      $(`#${activePage} .card-box`).css('display', 'block');
    });
  });

  currentFolderLinkID = this.id;
  currentFolderLinkID = currentFolderLinkID.replace(/_anchor/g, '');
}
});

$('footer').dblclick(() => {
refreshPage();
});

// $('.tab-content').mouseover(() => {
// $('#editUI').css('display', 'block');
// });

// $('.tab-content').mouseout(() => {
// $('#editUI').css('display', 'none');
// });

enableProtocolFunctionality();

//***   CORE FUNCTIONALITY OF HIERARCHY   ***\\
$('#editUI').click(function decideAction() {
if ($(this).text() === 'Edit') {

  $('body').append(`<div id="editModeNotify" class="notifyjs-corner" style="top: 0px; left: 0px;"><div class="notifyjs-wrapper notifyjs-hidable">
                      <div class="notifyjs-arrow" style=""></div>
                      <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-success"><div class="image" data-notify-html="image"><i class="fa fa-check"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title">Edit Mode Activated (CLICK TO DISMISS)</div><div class="text" data-notify-html="text">You are currently in 'Edit Mode':  <br><br>  1 - TO EDIT THE TITLES AND TEXT: Double click on the text to get the cursor and click again to start editing.  <br><br>  2 - TO DELETE: Double click the text to get the cursor and delete all the text from the object, then click anywhere on the screen.  <br><br>  3 - TO SAVE YOUR CHANGES: Click the 'Submit' button.</div></div></div></div>
                    </div></div>`);

  let editNotifyTimer = setTimeout(() => {
    $('#editModeNotify').remove();
  }, 30000);

  $('#editModeNotify').click(function removeNotification() {
    clearTimeout(editNotifyTimer);
    $(this).remove();
  });

  // $.Notification.notify('success', 'top left', 'Edit Mode Activated', "You are currently in 'Edit Mode':  <br><br>  1 - To edit, the titles and text, double click on text to get cursor and click again to start editing.  <br><br>  2 - To delete, double click the text to get cursor and delete all text from the object, then click anywhere on the screen.  <br><br>  3 - To save your changes click the 'Submit' button.");

  /* EDIT */
  mainTabEdit();
  submenuEdit();
  protocolEdit();

  /* CREATE */
  addMainTabs();
  addSubmenus();
  addProtocols();

  $('#addMainTab').animate({
    width: '100%',
  }, 650);

  $('#addSubmenu').animate({
    height: '20%',
  }, 650, function animateHeight() {
    $(this).css('height', '5%');
  });

  setTimeout(() => { $('.ion-android-add').addClass('grow'); }, 200); // New Plus buttons' animation

  $(this).fadeOut(325, function fadeIn() {
    $(this).text('Submit').fadeIn(325);
  });

  $('.jstree').jstree({
    plugins: ['contextmenu', 'dnd', 'search', 'state', 'types', 'wholerow'],
  });

  $('.protocol').attr('href', 'javascript:void(0)');
  // $(".jstree").jstree(true).refresh();
} else if ($(this).text() === 'Submit') {
  /* CREATE */
  postCreateNewElementData();

  /* EDIT */
  postEditElementData();

  setTimeout(() => { window.location.href = 'https://projects.braijonglover.com/kb/modules/kb/'; /* refreshPage(); */ }, 500); // Give the new tab file time to be created
}
});
