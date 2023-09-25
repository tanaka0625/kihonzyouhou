<template>
    <div>
        <div v-if="show_form()">
            <h2>単語編集</h2>
            <div>
                <form :action=url method="post">
                    <label for="form_word">単語</label>
                    <input type="text" name="word" id="form_word" :value="word.word"><br>
                    <label for="form_text">解説</label>
                    <textarea name="text" id="form_text" cols="30" rows="10" v-model="word.text"></textarea><br>
                    <div>
                        <label for="form_category">大分類</label>
                        <select name="category_id" id="form_category" v-model="selected_category">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category}}</option>
                        </select>
                    </div>
                    <div>
                        <label for="form_sub_category">中分類</label>
                        <select name="sub_category_id" id="form_sub_category" v-model="selected_sub_category">
                            <option v-for="sub_category in find_sub_category_options()" :key="sub_category.id" :value="sub_category.id">{{ sub_category.sub_category}}</option>
                        </select>
                    </div>
                    <input type="submit" value="送信" class="btn btn-dark">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categories: {
            type: Array,
            requires: true
        },
        sub_categories: {
            type: Array,
            required: true
        },
        word: {
            type: Object,
            requires: true
        },
        edit_form_word_id: {
            type: Number,
            required: true
        }

    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            url: "edit/" + this.word.id,
            selected_category: this.word.category_id,
            selected_sub_category: this.word.sub_category_id,
        };
    },
    methods: {
        show_form: function() {
            return this.edit_form_word_id === this.word.id;
        },
        find_category: function (category_id){
            let result = this.categories.find((category) => category.id == category_id);
            return result;
        },
        find_sub_category: function (sub_category_id){
            let result = this.sub_categories.find((sub_category) => sub_category.id == sub_category_id);
            return result;                
        },
        find_sub_category_options: function (){
            let ary = {};
            for(let i=0; i<this.sub_categories.length; i++)
            {
                if(this.selected_category === this.sub_categories[i].category_id)
                {
                    ary[Object.keys(ary).length] = this.sub_categories[i];
                }
            }
            return ary;
        }
    }
}
</script>