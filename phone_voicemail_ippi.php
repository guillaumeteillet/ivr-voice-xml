<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<vxml version = "2.1">
    <form id="main">
       <block name="main_selection">
         <prompt>
           <audio  src="./sounds/fr1.wav">
             Good Morning ! I am Guillaume Teillet ! I am not available right now.
             Please listen carefully the different options you have to reach me :
           </audio>
        </prompt>
        <goto next="#menu" />
       </block>
     </form>

     <menu id="menu" dtmf="true">
        <property name="inputmodes" value="dtmf"/>
        <prompt>
          <audio  src="./sounds/fr2.wav">
            If you want to talk to me about a job offer, press 1.
            If you want to leave me a private message, press 2.
            If you need to talk to me urgently, press 3.
          </audio>
        </prompt>
        <choice dtmf="1" next="#job_offer"/>
        <choice dtmf="2" next="#private_message"/>
        <choice dtmf="3" next="#urgence"/>
      </menu>

      <menu id="job_offer" dtmf="true">
         <property name="inputmodes" value="dtmf"/>
         <prompt>
           <audio  src="./sounds/fr3.wav">
             Thank you for your call. If we have already been in contact by email or telephone, press 1 to leave me a message.
             If this is the first time you contact me, press 2.
           </audio>
         </prompt>
         <choice dtmf="1" next="#private_message"/>
         <choice dtmf="2" next="#new_job_offer"/>
       </menu>

      <menu id="new_job_offer" dtmf="true">
         <property name="inputmodes" value="dtmf"/>
         <prompt>
           <audio  src="./sounds/fr4.wav">
             To be effective in the study of the proposals made to me, thank you to send me an email with your offer to establish a first contact.
             You can find my email address on my linkedin profile.
           </audio>
        </prompt>
         <choice dtmf="*" next="#menu"/>
       </menu>

     <form id="private_message">
       <transfer name="T_3" bridge="true" dest="sip:YOUR_IPPI_ADDRESS@ippi.fr" cond="true" connecttimeout="500s" expr="">
         <prompt>
           <audio  src="./sounds/fr5.wav">
             You will be redirected to my voicemail where you can leave me a message.
             Don’t forget to give me your name, email address and phone number if you want an answer.
             Thank you and and see you soon.
           </audio>
          </prompt>
          </transfer>
      </form>

     <form id="voicemail">
       <transfer name="voicemail" bridge="true" dest="sip:YOUR_IPPI_ADDRESS@ippi.fr" cond="true" expr="">
         <prompt>
           <audio  src="./sounds/fr6.wav">
             Don’t forget to give me your name, email address and phone number if you want an answer.
             Thank you and and see you soon.
           </audio>
          </prompt>
          </transfer>
      </form>

      <menu id="urgence" dtmf="true">
         <property name="inputmodes" value="dtmf"/>
         <prompt>
           <audio  src="./sounds/fr7.wav">
             Please note you will be connected, thank you to use this feature for emergencies only.
             If you wish to proceed, press 1 to confirm.
           </audio>
         </prompt>
         <choice dtmf="1" next="#urgence_transfer"/>
       </menu>

     <form id="urgence_transfer">
       <transfer name="T_3" bridge="true" dest="tel:+YOURPHONENUMBER" cond="true" expr="">
         <prompt>
           <audio  src="./sounds/fr8.wav">
               Transfering your call, please wait.
           </audio>
          </prompt>
          <filled>
          <if cond="T_3 == 'busy'">
            <prompt>
                <audio  src="./sounds/fr9.wav">
                    Sorry, I am not available right now, you will be redirected to my voicemail.
                </audio>
            </prompt>
            <goto next="#voicemail" />
          <elseif cond="T_3 == 'noanswer'" />
            <prompt>
              <audio  src="./sounds/fr9.wav">
                  Sorry, I am not available right now, you will be redirected to my voicemail.
              </audio>
            </prompt>
            <goto next="#voicemail" />
          </if>
          </filled>
          </transfer>
      </form>

</vxml>
