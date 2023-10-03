<template>
    <div>
        <div>
            <button class="btn btn-dark" v-on:click="show_filter()">フィルター</button>
            <div v-if="is_visible_filter">
                <div>
                    <h3>大機能</h3>
                    <div v-for="category in categories" :key="category.id">
                        <label>
                            {{ category.category }}<input type="checkbox" name="category_checkbox" :value="category.id" v-model="selected_category_ids">
                        </label>
                    </div>
                </div>

                <div>
                    <h3>中機能</h3>
                    <div v-for="sub_category in sub_categories" :key="sub_category.id">
                        <label>
                            {{ sub_category.sub_category }}<input type="checkbox" name="sub_category_checkbox" :value="sub_category.id" v-model="selected_sub_category_ids">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
                <tr><th>id</th><th>単語</th><th>意味</th><th>大分類</th><th>中分類</th><th>出題回数</th><th>分からなかった回数</th></tr>
                <tr v-for="word in selected_words" :key="word.id" :value="word.id">
                    <td>
                        {{word.id}}
                        <button class="btn btn-primary" type="button" v-on:click="show_edit_form(word.id)">編集</button>
                        <form-edit-word-component :word="word" :category="find_category(word.category_id)" :sub_category="find_sub_category(word.sub_category_id)" :edit_form_word_id="id" :categories="categories" :sub_categories="sub_categories"></form-edit-word-component>
                    </td>
                    <td>{{word.word}}</td>
                    <td>{{word.text}}</td>
                    <td>{{find_category(word.category_id).category}}</td>
                    <td>{{find_sub_category(word.sub_category_id).sub_category}}</td>
                    <td>{{word.question_count}}</td>
                    <td>{{word.mistake_count}}</td>
                </tr> 
        </table>



    </div>

</template>
    <div>

    </div>


<script>
    export default {
        props: {
            words: {
                type: Array,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            sub_categories: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                is_visible_form: false,
                id: 0,
                selected_category_ids: [],
                selected_sub_category_ids: [],
                category_ckbox_status: false,
                sub_category_ckbox_status: false,
                is_visible_filter: false,
                selected_words: []
            };
        },
        created: function() {
            let array = [];
            this.categories.forEach(function(category){
                array.push(category.id);
            });
            this.selected_category_ids = array;

            let array2 = [];
            this.sub_categories.forEach(function(sub_category){
                array2.push(sub_category.id);
            });
            this.selected_sub_category_ids = array2;

            // 表示する単語に受け取った全単語を選択
            this.selected_words = this.words;
        },
        watch: {
            selected_category_ids: function(newVal, oldVal) {
                if(this.category_ckbox_status){

                    // 無限ループ対策　selected_sub_category_idsが動かないように
                    this.sub_category_ckbox_status = false;

                    if(newVal.length < oldVal.length){
                        // 大機能のチェックを外した場合

                        // 差分抽出
                        let difference = [];
                        difference = oldVal.filter(category_id=> newVal.indexOf(category_id) == -1);

                        // 差分に紐づく中機能を取得
                        let deleted_sub_categories;
                        deleted_sub_categories = this.sub_categories.filter(sub_category => sub_category.category_id === difference[0]);
                        let deleted_sub_category_ids = deleted_sub_categories.map(function(value) {
                            return value["id"];
                        });

                        // 差分に紐づく中機能をselected_sub_category_idsから削除
                        let new_sub_category_ids;
                        new_sub_category_ids = this.selected_sub_category_ids.filter(function(sub_category_id){
                            return deleted_sub_category_ids.indexOf(sub_category_id) == -1;
                        },deleted_sub_category_ids);

                        this.selected_sub_category_ids = new_sub_category_ids;
                        // console.log(this.selected_sub_category_ids);
                        // console.log(new_sub_category_ids);
                        // console.log(deleted_sub_category_ids);

                        // フィルターが掛かった単語をセット
                        this.set_words();

                    }else{
                        // 大機能にチェックを追加した場合

                        // 差分抽出
                        let difference = [];
                        difference = newVal.filter(category_id=> oldVal.indexOf(category_id) == -1);

                        // 差分に紐づく中機能を取得
                        let added_sub_categories;
                        added_sub_categories = this.sub_categories.filter(sub_category => sub_category.category_id === difference[0]);

                        // 差分に紐づく中機能をselected_sub_category_idsに追加
                        for(let i=0; i<added_sub_categories.length; i++){
                            this.selected_sub_category_ids.push(added_sub_categories[i].id);
                        }
                        let array = Array.from(new Set(this.selected_sub_category_ids));
                        this.selected_sub_category_ids = array;

                        // フィルターが掛かった単語をセット
                        this.set_words();
                    }
                }else{
                    this.category_ckbox_status = true;

                }

 
            },
            selected_sub_category_ids: function(newVal, oldVal) {
                if(this.sub_category_ckbox_status){

                    // 無限ループ対策　selected_sub_category_idsが動かないように
                    this.category_ckbox_status = false;

                    let array=[];
                    for(let i=0; i<newVal.length; i++){
                    
                        let result;
                        result = this.sub_categories.find(function(sub_category){
                            return newVal[i] === sub_category.id;
                        });
                        array[i] = result.category_id;
                    };
                    let array2 = Array.from(new Set(array));
                    this.selected_category_ids = array2;

                    // フィルターが掛かった単語をセット
                    this.set_words();
                }else{
                    this.sub_category_ckbox_status = true;

                }
 
            },

        },
        methods: {
            find_category: function (category_id){
                let result = this.categories.find((category) => category.id == category_id);
                return result;
            },
            find_sub_category: function (sub_category_id){
                let result = this.sub_categories.find((sub_category) => sub_category.id == sub_category_id);
                return result;                
            },
            To_edit_page: function (word_id){
                this.$router.push('edit/');
            },
            edit_href: function (id){
                
                let url = "location.href='/edit/" +id+"'";
                return url;
                
            },
            show_edit_form: function (id){
                if(this.id === id)
                {
                    this.id = 0;
                }else{
                    this.id = id;
                }
            },
            show_filter: function (){
                if(this.is_visible_filter){
                    this.is_visible_filter = false;
                }else{
                    this.is_visible_filter = true;

                }
            },
            set_words: function(){
                let new_words = [];
                new_words = this.words.filter(word=> this.selected_sub_category_ids.indexOf(word.sub_category_id) != -1);
                this.selected_words = new_words;
            }
        }
    }
</script>