<template>
    <div>
        <button class="btn btn-dark" v-on:click="show_form_sub_category()">中項目追加</button>
        <div v-if="is_visible_form_sub_category">
            <form action="/post/sub_category" method="post">
                <div>
                    <select name="category_id">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category}}</option>
                    </select>
                </div>
                <label for="sub_category">中項目</label>
                <input type="text" name="sub_category" id="sub_category">
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
                required: true
            }
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                is_visible_form_sub_category: false
            };
        },
        methods: {
            show_form_sub_category: function() {
                if(this.is_visible_form_sub_category)
                {
                    this.is_visible_form_sub_category = false;
                }else{
                    this.is_visible_form_sub_category = true;
                }
            }
        }
    }

</script>