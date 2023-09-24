<template>
        <div>
            <button class="btn btn-dark" v-on:click="show_form_word()">単語追加</button>
            <div v-if="is_visible_form_word">
                <form action="/post/word" method="post">
                    <label for="text">単語</label>
                    <input type="text" name="word" id="form_word"><br>
                    <label for="form_text">解説</label>
                    <textarea name="text" id="form_text" cols="30" rows="10"></textarea><br>
                    <div>
                        <label for="form_category">大分類</label>
                        <select name="category_id" id="form_category">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category}}</option>
                        </select>
                    </div>
                    <div>
                        <label for="form_sub_category">中分類</label>
                        <select name="sub_category_id" id="form_sub_category">
                            <option v-for="sub_category in sub_categories" :key="sub_category.id" :value="sub_category.id">{{ sub_category.sub_category}}</option>
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
            is_visible_form_word: false
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
        }
    }
}

</script>