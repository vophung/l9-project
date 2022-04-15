$("#title").keyup(function() {
    var Text = $(this).val();
    var result = toSlug(Text);
    $("#slug").val(result);        
});

function toSlug(str) {
	// Chuyển hết sang chữ thường
	str = str.toLowerCase();     
 
	// xóa dấu
	str = str
		.normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
		.replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
 
	// Thay ký tự đĐ
	str = str.replace(/[đĐ]/g, 'd');
	
	// Xóa ký tự đặc biệt
	str = str.replace(/([^0-9a-z-\s])/g, '');
 
	// Xóa khoảng trắng thay bằng ký tự -
	str = str.replace(/(\s+)/g, '-');
	
	// Xóa ký tự - liên tiếp
	str = str.replace(/-+/g, '-');
 
	// xóa phần dư - ở đầu & cuối
	str = str.replace(/^-+|-+$/g, '');
 
	// return
	return str;
}

$(() => {
	let $in = $('#in');
	let $out = $('#out');
	
	function update() {
		$out.text(toSlug($in.val()));
	}
	update();
	
	$in.on('change', update);
})
CKEDITOR.replace( 'summary-ckeditor' );

// console.log(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(1000));

function parseSentenceForNumber(sentence){
  return parseFloat(sentence.replace(/,(?=\d)/g,"").match(/-?\.?\d.*/g));
}

$("input[id='price']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});

function calculate(main, disc) {
  var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
  var mult = main * dec; // gives the value for subtract from main value
  var discount = main - mult;
  return discount;
}

$(document).on("change keyup blur", "#price", function() {
  var main = parseSentenceForNumber(this.value);
  if($('#discount').val().length == 0 || $('#discount').val().length == 1) {
    $('#sum').val(main);
    formatCurrency($('#sum'));
  }else {
    $('#text-error .error').text('');
    var disc =  parseSentenceForNumber($('#discount').val())
    let total = calculate(main, disc);
    formatCurrency($('#sum'));
    $('#sum').val(total);
  }
});

$(document).on("change keyup blur", "#discount", function() {
  var disc = parseSentenceForNumber(this.value);
  if(this.value.length == 1 || this.value.length == 0) {
    disc = 0; 
  }
  if($('#price').val().length == 0){
    $text = 'Vui long nhap so tien';
    $('#text-error .error').text($text);
  }else {
    var main =  parseSentenceForNumber($('#price').val())
    let total = calculate(main, disc);
    $('#sum').val(total);
    formatCurrency($('#sum'));
  }
  // var main = parseSentenceForNumber($('#price').val());
  // var disc =  parseSentenceForNumber($('#discount').val());
  // if(disc == null) disc = '0';
  // console.log(disc);
  // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
  // var mult = main * dec; // gives the value for subtract from main value
  // var discont = main - mult;
  // $('#sum').val(discont);
});

// While not a HTML5 input type='number', the solution bellow uses input type='text' to the same effect. The rational of not using type='number' being humans require a nicely formatted string like "23.75%" while robots prefer to read integers and floating points should be avoided. The snippet bellow does just that to 2 decimal places.

// I haven't tested it on a mobile, but I think the number pad should appear as with input type='number'.

// Codepen.io: Commented code can be found here

document.querySelector('#discount').addEventListener('input', function(e) {
  let int = e.target.value.slice(0, e.target.value.length - 1);

  if (int.includes('%')) {
    e.target.value = '%';
  } else if (int.length >= 3 && int.length <= 4 && !int.includes('.')) {
    e.target.value = int.slice(0, 2) + '.' + int.slice(2, 3) + '%';
    e.target.setSelectionRange(4, 4);
  } else if (int.length >= 5 & int.length <= 6) {
    let whole = int.slice(0, 2);
    let fraction = int.slice(3, 5);
    e.target.value = whole + '.' + fraction + '%';
  } else {
    e.target.value = int + '%';
    e.target.setSelectionRange(e.target.value.length - 1, e.target.value.length - 1);
  }
  // console.log('For robots: ' + getInt(e.target.value));
});

function getInt(val) {
  let v = parseFloat(val);
  if (v % 1 === 0) {
    return v;
  } else {
    let n = v.toString().split('.').join('');
    return parseInt(n);
  }
}


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

$("input[type=tel]").keydown(function (event) {
    return (event.which >= 48 && event.which <= 57) || //0 TO 9
    event.which === 8 || event.which == 46; //BACKSPACE/DELETE
});

function maxlength(event)
{
    const ele = event.target;
    const maxlength = ele.maxLength;
    const value = ele.value;
    if (event.type == 'keypress')
    {
        if (value.length >= maxlength)
        {
            event.preventDefault();
        }
    }
    else if (event.type == 'keyup')
    {
        if (value.length > maxlength)
        {
            ele.value = value.substring(0, maxlength);
        }
    }
}

$('input[type=tel][maxlength]').on('keypress keyup', maxlength);

function formatCurrency(input) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = input_val + 'VND';
    
    // final formatting
    // if (blur === "blur") {
    //   input_val += ".00";
    // }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });