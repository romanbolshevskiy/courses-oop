<?php
	return array(
		

		//видалення замовлень
		'/order-detail/delete/([0-9]+)' => 'orders/deleteDetail/$1', 
		'/admin/order/delete/([0-9]+)' => 'orders/deleteOrder/$1', 
		'/admin/order/bought/([0-9]+)' => 'orders/buyOrder/$1',
		
		//search 	
		'/find/' => 'find/index',
		
		//chat
		'/update-chat/'=> 'chat/chatUpdate',
		'/get-messages/'=> 'chat/getChatMessages',
		'/chat/'=> 'chat/index',


		'/ajax/'=> 'site/ajax',
		'/addCart/' => 'cart/addCart', 

		'/cart/delete/all' => 'cart/deleteAll',
		'/cart/delete/([0-9]+)' => 'cart/delete/$1',
		'/cart/processing' => 'cart/processing',
		'/cart/bought' => 'cart/bought',
		'/cart/checkout' => 'cart/checkout',
		'/cart/' => 'cart/index',


		'/teacher/delete/([0-9]+)' => 'teachers/delete/$1',
		'/teacher/edit/([0-9]+)' => 'teachers/edit/$1',
		'/teacher/([0-9]+)' => 'teachers/teacher/$1',
		'/teachers/' => 'teachers/teachers',
		
		'/main-courses/'=>'mainCourses/main_courses',
		'/main-course/create'=>'mainCourses/create_main_course',
		'/main-course/edit/([0-9]+)'=>'mainCourses/edit_main_course/$1',
		'/course-main/delete/([0-9]+)'=>'mainCourses/delete/$1',

		'/courses/page-([0-9]+)' => 'courses/courses/$1', //actionCourses ContentController
		
		'/courses/([a-z0-9-]+)' => 'courses/one/$1', //actionCourses ContentController
		
		'/courses/' => 'courses/courses', //actionCourses ContentController
		
		'/course/create' => 'courses/create', //actionCreate CourseController
		'/course/edit/([0-9]+)' => 'courses/edit/$1', 
		'/course/delete/([0-9]+)' => 'courses/delete/$1', //actionCreate CourseController
		
		'/user/register/' => 'user/register',
		'/activation/' => 'user/activation',

		'/user/login' => 'user/login',
		'/user/logout' => 'user/logout',
		'/cabinet/edit' => 'cabinet/edit', //actionEdit CabinetController
		'/cabinet/delete' => 'cabinet/delete', //actionEdit CabinetController

		'/cabinet/' => 'cabinet/index', //actionIndex CabinetController
		'/contact' => 'site/contact', //actionContact sITEController

		'/my-courses/' => 'courses/myCourses',
		// // Управление заказами:    
		// 'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
		//'admin/orders/delete/([0-9]+)' => 'adminOrder/delete/$1',
		// 'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
		'/admin/orders' => 'admin/orders', 
		//'/orders' => 'orders/all',
		//видалення деталі аяксом
		//'/deleteDetail/' => 'orders/deleteDetail',

		'/' => 'site/index'  //  actionIndex в SiteController

	);