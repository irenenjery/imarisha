/* EXTABLE.JS 0.1 by Irene Njeri */
"use strict";
document.addEventListener("click", function(event) {
	 if ( event.target.closest(".extable-btn") ) {
    extableBtnHandler(event);
  }
});

function extableBtnHandler(event) {
  let target = event.target;

  if ( target.closest(".extable-btn-submit") ) {
    submitHandler(event);
  } else if ( target.closest(".extable-btn-modes") ) {
  	modeTransitionHandler(event);
  } else if ( target.closest(".extable-btn-add") ) {
    addExHandler(event);
  }
}
function modeTransitionHandler(event) {
	if (!event.target.closest(".extable-btn-modes")) return;

  let target = event.target,
      targetTable = target.closest(".extable"),//action table
      targetRow = target.closest(".extable-row"),//action row
      trClasses = targetRow.classList,
      extableRowStud = targetTable.querySelector(".stud"),
      studExInstr = extableRowStud.querySelector(".extable-ex_instr"),
      //target btn
      btn = target.closest(".extable-btn"),
      btnClasses = btn.classList,
      //submit button
      btnSubmit = targetTable.querySelector(".extable-btn-submit button");

  if ( btnClasses.contains("extable-btn-edit") ) {//default|edited -> editing
  	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
      	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
        exInstr = targetRow.querySelector(".extable-ex_instr");

    hideElem(defaultBtnMode);
    showElem(editBtnMode);

    // trClasses.remove('edited-elem');
    trClasses.add('editing-elem');

    exInstr.removeAttribute('readonly');

    exInstr.dataset.OgValue = exInstr.value;
  } else if ( btnClasses.contains("extable-btn-confirm-edit") ) {//editing -> edited
  	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
      	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
        exInstr = targetRow.querySelector(".extable-ex_instr");

    hideElem(editBtnMode);
    showElem(defaultBtnMode);

    trClasses.remove('editing-elem');
    exInstr.setAttribute('readonly', 'true');

    if ( exInstr.dataset.OgValue == exInstr.value ) return;//same as editing -> default
    //Dead code if no actual change made
    if ( !trClasses.contains('new-elem') ) trClasses.add('edited-elem');

    exInstr.value = exInstr.value || studExInstr.value;

  	//TODO: make fn;enableBtn(btn)
  	btnSubmit.classList.remove('disabled');
  	btnSubmit.removeAttribute('disabled');
  } else if ( btnClasses.contains("extable-btn-cancel-edit") ) {//editing -> default
  	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
      	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
        //exercise data
        exInstr = targetRow.querySelector(".extable-ex_instr");
        
    hideElem(editBtnMode);
    showElem(defaultBtnMode);

    trClasses.remove('editing-elem');

    exInstr.value = exInstr.dataset.OgValue || studExInstr.value;
    exInstr.setAttribute('readonly', 'true');
  } else if ( btnClasses.contains("extable-btn-delete") ) {//default|edited -> deleting      
  	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
      	deleteBtnMode = targetRow.querySelector(".extable-btn-mode-delete");
        
    hideElem(defaultBtnMode);
    showElem(deleteBtnMode);
    
    trClasses.add("deleting-elem");
  } else if ( btnClasses.contains("extable-btn-cancel-delete") ) {//deleting -> default|edited
  	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
      	deleteBtnMode = targetRow.querySelector(".extable-btn-mode-delete");
        
    hideElem(deleteBtnMode);
    showElem(defaultBtnMode);
    
    trClasses.remove("deleting-elem");
  } else if ( btnClasses.contains("extable-btn-confirm-delete") ) {//deleting -> deleted
  	//TODO: when deleting a new row, submit btn remains active when no other activity
    if (!trClasses.contains('new-elem')) {
      let deleteWpids = targetTable.querySelector('.delete-wp_ids'),//sequence of wp_ids
	        deleteWpidsStr = deleteWpids.value,
      		wp_id = targetRow.querySelector('.extable-wp_id').value,
          delete_count_box = targetTable.querySelector('.delete-count');
      
      if ( deleteWpidsStr.length ) deleteWpidsStr += ',';
      deleteWpids.value = deleteWpidsStr + wp_id;//assumes wp_id exists and distinct
      
      ++delete_count_box.value;

  		btnSubmit.classList.remove('disabled');
  		btnSubmit.removeAttribute('disabled');
    }
    targetRow.remove();
  }
}
function submitHandler(event, targetTable=undefined) {
  event.preventDefault();

  targetTable = targetTable || event.target.closest(".extable");

  //Insert, Update, Delete
  let insert_count = update_count = 0,
      delete_count = targetTable.querySelector('.delete-count').value,
      deleteWpidsStr = targetTable.querySelector(".delete-wp_ids").value,
      new_rows = targetTable.querySelectorAll('tr.new-elem:not(.stud)'),
      edited_rows = targetTable.querySelectorAll('tr.edited-elem');

  for (let i = 0; i < new_rows.length; i++) {
    let row = new_rows[i];
    insert_count++;
    row.querySelector('.extable-ex_id').setAttribute('name', 'insert-ex_id-'+i);
    row.querySelector('.extable-ex_instr').setAttribute('name', 'insert-ex_instr-'+i);
  }

  for (let i = 0; i < edited_rows.length; i++) {
    let row = edited_rows[i];
    update_count++;
    row.querySelector('.extable-wp_id').setAttribute('name', 'update-wp_id-'+i);
    row.querySelector('.extable-ex_id').setAttribute('name', 'update-ex_id-'+i);
    row.querySelector('.extable-ex_instr').setAttribute('name', 'update-ex_instr-'+i);
  }

  if (insert_count == 0 && update_count == 0 && delete_count == 0) return;

  let insert_count_box = targetTable.querySelector('.insert-count'),
      update_count_box = targetTable.querySelector('.update-count');

  // alert(`Inserts: ${insert_count}, Updates: ${update_count}, Deletes: ${delete_count}`);
  insert_count_box.value = insert_count;
  update_count_box.value = update_count;

  targetTable.closest(".extable-form").submit();
}
function addExHandler(event, targetTable=undefined, extableRowStud=undefined) {
  let target = event.target,
  		targetRow = target.closest(".extable-row"),
      selectEx = targetRow.querySelector(".extable-select-ex"),
      selectExErrClasses = targetRow.querySelector(".select-ex-error").classList;

  if (selectEx.value == 'none') {
    selectExErrClasses.remove('hide');
    return;
  }
  selectExErrClasses.add('hide');
	
	targetTable = targetTable || target.closest(".extable");
  extableRowStud = extableRowStud || targetTable.querySelector(".stud");

  let btnSubmit = targetTable.querySelector(".extable-btn-submit button"),
  		newExRow = extableRowStud.cloneNode(true),
      newExTitle = newExRow.querySelector(".extable-ex_title"),
      newExId = newExRow.querySelector(".extable-ex_id"),
      newExInstr = newExRow.querySelector(".extable-ex_instr"),
      studExInstr = extableRowStud.querySelector(".extable-ex_instr"),
      addInstr = targetRow.querySelector(".extable-add-instr"),
      selectedExOption = selectEx.options[selectEx.selectedIndex],
      rowSubmit = targetTable.querySelector(".extable-row-submit");//one per table

	//TODO: make fn;enableBtn(btn)
	btnSubmit.classList.remove('disabled');
	btnSubmit.removeAttribute('disabled');

  newExRow.classList.remove('stud');

  newExTitle.textContent = selectedExOption.textContent;

  newExId.value = selectEx.value;

  newExInstr.value = addInstr.value || studExInstr.value;     

  rowSubmit.before(newExRow);
}