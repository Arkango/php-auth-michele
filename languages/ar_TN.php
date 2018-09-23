<?php
$lang = array();

$lang['user_blocked'] = "أنت حاليا مقفل خارج النظام.";
$lang['user_verify_failed'] = "كود كابتشا غير صالحة.";

$lang['email_password_invalid'] = "عنوان البريد الالكتروني / كلمة المرور غير صالح.";
$lang['email_password_incorrect'] = "عنوان البريد الالكتروني / كلمة المرور غير صحيح.";
$lang['remember_me_invalid'] = "حقل تذكرني غير صالح.";

$lang['password_short'] = "كلمة المرور قصيرة جدا.";
$lang['password_weak'] = "كلمة المرور ضعيفة جدا.";
$lang['password_nomatch'] = "كلمات المرور غير متطابقة.";
$lang['password_changed'] = "تم تغيير كلمة المرور بنجاح.";
$lang['password_incorrect'] = "كلمة المرور الحالية غير صحيحة.";
$lang['password_notvalid'] = "كلمة المرور غير صالحة.";

$lang['newpassword_short'] = "كلمة مرور جديدة قصيرة جدا.";
$lang['newpassword_long'] = "كلمة مرور جديدة طويلة جدا.";
$lang['newpassword_invalid'] = "كلمة المرور الجديدة يجب أن تحتوي على حرف كبير وصغير واحد على الأقل، و رقم واحد على الأقل.";
$lang['newpassword_nomatch'] = "كلمات المرور جديدة غير متطابقة.";
$lang['newpassword_match'] = "كلمة المرور الجديدة هي نفس كلمة المرور القديمة.";

$lang['email_short'] = "عنوان البريد الإلكتروني قصير جدا.";
$lang['email_long'] = "عنوان البريد الإلكتروني طويل جدا.";
$lang['email_invalid'] = "عنوان البريد الإلكتروني غير صالح.";
$lang['email_incorrect'] = "عنوان البريد الإلكتروني غير صحيح.";
$lang['email_banned'] = "هذا عنوان البريد الإلكتروني غير مسموح به.";
$lang['email_changed'] = "تم تغيير عنوان البريد الإلكتروني بنجاح.";

$lang['newemail_match'] = "عنوان البريد الإلكتروني الجديد متطابق مع السابق.";

$lang['account_inactive'] = "لم يتم تنشيط الحساب.";
$lang['account_activated'] = "تم تنشيط الحساب.";

$lang['logged_in'] = "أنت الآن قمت بتسجيل الدخول.";
$lang['logged_out'] = "أنت الآن قمت بتسجيل الخروج.";

$lang['system_error'] = "تم مصادفة خطأ في نظام. حاول مرة اخرى.";

$lang['register_success'] = "تم إنشاء حساب. بريد تفعيل إرسلت إلى البريد الإلكتروني.";
$lang['register_success_emailmessage_suppressed'] = "تم إنشاء حساب.";
$lang['email_taken'] = "عنوان البريد الإلكتروني مستخدم من قبل.";

$lang['resetkey_invalid'] = "مفتاح إعادة تعيين غير صالح.";
$lang['resetkey_incorrect'] = "مفتاح إعادة تعيين غير صحيح.";
$lang['resetkey_expired'] = "انتهت صلاحية مفتاح إعادة تعيين.";
$lang['password_reset'] = "تمت إعادة تعيين كلمة المرور بنجاح.";

$lang['activationkey_invalid'] = "مفتاح التنشيط غير صالح.";
$lang['activationkey_incorrect'] = "مفتاح التنشيط غير صحيح.";
$lang['activationkey_expired'] = "انتهت صلاحية مفتاح التنشيط.";

$lang['reset_requested'] = "طلب إعادة تعيين كلمة المرور تم إرسالها إلى عنوان البريد الإلكتروني.";
$lang['reset_requested_emailmessage_suppressed'] = "تم إنشاء طلب إعادة تعيين كلمة المرور.";
$lang['reset_exists'] = "طلب إعادة تعيين كلمة مرور  موجود بالفعل.";

$lang['already_activated'] = " الحساب نشط من قبل.";
$lang['activation_sent'] = "تم إرسال بريد التنشيط.";
$lang['activation_exists'] = "وقد تم بالفعل إرسال بريد التنشيط.";

$lang['email_activation_subject'] = '%s - تفعيل الحساب';
$lang['email_activation_body'] = 'مرحبا،<br/><br/>  لتكون قادرة على تسجيل الدخول إلى الحساب الخاص بك تحتاج أولا لتفعيل الحساب الخاص بك عن طريق النقر على الرابط التالي: <strong><a href="%1$s/%2$s">%1$s/%2$s</a></strong><br/><br/> ثم تحتاج إلى استخدام مفتاح تفعيل التالية: <strong>%3$s</strong><br/><br/> إذا كنت لم تسجل على %1$s مؤخرا ثم أرسلت هذه الرسالة عن طريق الخطأ، الرجاء تجاهله.';
$lang['email_activation_altbody'] = ' مرحبا،' . "\n\n" . 'لتكون قادرة على تسجيل الدخول إلى الحساب الخاص بك تحتاج أولا لتفعيل الحساب الخاص بك عن طريق النقر على الرابط التالي: ' . "\n" . '%1$s/%2$s' . "\n\n" . 'ثم تحتاج إلى استخدام مفتاح تفعيل التالية: %3$s' . "\n\n" . 'إذا كنت لم تسجل على %1$s مؤخرا ثم أرسلت هذه الرسالة عن طريق الخطأ، الرجاء تجاهله.';

$lang['email_reset_subject'] = '%s - طلب إعادة تعيين كلمة المرور';
$lang['email_reset_body'] = 'مرحبا،<br/><br/>لإعادة تعيين كلمة المرور الخاصة بك انقر على الرابط التالي: <br/><br/><strong><a href="%1$s/%2$s">%1$s/%2$s</a></strong><br/><br/>ثم تحتاج إلى استخدام مفتاح إعادة تعيين كلمة المرور التالية: <strong>%3$s</strong><br/><br/>إذا كنت لم تطلب إعادة تعيين كلمة المرور مؤخرا على %1$s ثم أرسلت هذه الرسالة عن طريق الخطأ، الرجاء تجاهله.';
$lang['email_reset_altbody'] = 'مرحبا، ' . "\n\n" . 'لإعادة تعيين كلمة المرور الخاصة بك انقر على الرابط التالي:' . "\n" . '%1$s/%2$s' . "\n\n" . 'ثم تحتاج إلى استخدام مفتاح إعادة تعيين كلمة المرور التالية: %3$s' . "\n\n" . 'إذا كنت لم تطلب إعادة تعيين كلمة المرور مؤخرا على %1$s ثم أرسلت هذه الرسالة عن طريق الخطأ، الرجاء تجاهله.';

$lang['account_deleted'] = "تم حذف الحساب بنجاح.";
$lang['function_disabled'] = "تم تعطيل هذه الوظيفة.";

return $lang;