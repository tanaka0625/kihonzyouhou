<template>
        <div class="mt-1">
            <button class="btn btn-dark" v-on:click="show_form_word()">単語追加</button>
            <div v-if="is_visible_form_word">
                <form action="/post/word" method="post">
                    <label for="text">単語</label>
                    <input type="text" name="word" id="form_word"><br>
                    <label for="form_text">解説</label>
                    <textarea name="text" id="form_text" cols="30" rows="10"></textarea><br>
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
            requires: true
        },
        item: {
            type: Array
        }

    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            is_visible_form_word: false,
            selected_category: 0,
            selected_sub_category: 0,
        };
    },
    methods: {
        show_form_word: function () {
            if(this.is_visible_form_word === false)
            {
                this.is_visible_form_word = true;
            }else{
                this.is_visible_form_word = false;
            }
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