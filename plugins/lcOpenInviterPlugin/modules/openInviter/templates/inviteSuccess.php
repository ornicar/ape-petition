<?php
  use_javascript('/lcOpenInviterPlugin/js/jquery-1.2.6.js');
  use_javascript('/lcOpenInviterPlugin/js/openinviter.js');
  use_stylesheet('/lcOpenInviterPlugin/css/openinviter.css');
?>

 <? 
  foreach ($form as $widget_key => $widget)
  {
    if($widget->getName() == "contacts")
    {
    		$options = $widget->getWidget()->getOptions();
    		$choices = $options['choices'];
    }
  }
 
 ?>
 
 <div class="open-inviter-container">
   <h2>Send your invitation</h2>
   <form action="<?php echo url_for("openInviter/invite")?>" method="post" id="openinviter">
		 
		 <div id="open-inviter-contacts-list">
			 <table>
			   <tr>
			      <td colspan="2"><?= $form['contacts']->renderError() ?></td>
			   </tr>
			    <tr>
			      <td> <input type="checkbox" id="checkbox_selector" onChange="toggleAll(this)" /> </td>
			      <th> Contacts </th>
			    </tr>
		     <? foreach($choices as $email => $name): ?>
		       <tr>
		        <td> <?php echo $form['contacts']->getWidget()->renderTag("input", array("type" => "checkbox", "value" => $email, "name" => "showInviter[contacts][]", "id" => "showInviter_contacts_".$email)) ?> </td>
		        <td> <label for="showInviter_contacts_<?= $email ?>"><?= $name ?></td>
		       </tr>
		     <? endforeach; ?>
			 </table>
		 </div>
		 
		 <table id="invite-message">
		   <tr>
         <td><?php echo $form['message']->renderLabel()?></td>
         <td><?php echo $form['message'] ?></td>
       </tr>
       <tfoot>
        <tr>
          <td colspan="2">
            <input type="submit" value="Invite" />
          </td>
        </tr>
      </tfoot>
		 </table>
		 
		 <!-- hidden fields -->
		 <?= $form['email']; ?>
		 <?= $form['password']; ?>
		 <?= $form['provider']; ?>
		 <?= $form['sessionId']; ?>
		 <?= $form['plugType']; ?>
		 
   </form>
</div>
 