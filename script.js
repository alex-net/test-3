new Vue({
	el:'.content',
	data:{
		textjob:'',
		error:'',
		list:[],
	},
	/**
	 * инициализация 
	 */
	mounted:function(){
		// обновляем список .. 
		this.gettasklist();
	},
	methods:{
		/**
		 * отправка запроса на добавление новой задачи
		 * @return void
		 */
		sendNewTask:function(){
			var tn=this.textjob.trim();
			if (!tn.length){
				this.error='Заполните поле';
				return;
			}
			this.error='';
			// отправляем данные ..
			var t=this;
			var fd=new FormData();
			fd.append('query','add-task');
			fd.append('name',this.textjob);
			axios.post('',fd).then(function(ret){
				t.textjob='';
				t.gettasklist();

			});
			
		},
		/**
		 * запрос списка задач
		 */
		gettasklist:function(){
			var t=this;
			var fd=new FormData();
			fd.append('query','get-task-list');
			axios.post('',fd).then(function(ret){
				Vue.set(t,'list',ret.data.data);
			});
		},
		/**
		 * убийство одной задачи
		 */
		itemRemove:function(id){
			var fd= new FormData();
			var t=this;
			fd.append('query','kill-task');
			fd.append('id',id);

			axios.post('',fd).then(function(){
				t.gettasklist();
			});
		}


	}
});