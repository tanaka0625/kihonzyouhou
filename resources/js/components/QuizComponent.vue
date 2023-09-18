<template>
    <div>

        <h3>大機能</h3>
        <div v-for="category in categories" :key="category['category']">
            <label>
                {{ category["category"] }}<input type="checkbox" name="category_checkbox" v-model="category['is_checked']">{{ category['is_checked'] }}
            </label>
        </div>

        <h3>中機能</h3>
        <div v-for="(sub_category, index) in sub_categories" :key="sub_category.id">
            <label>
                {{ sub_category.sub_category }}<input type="checkbox" name="category_checkbox" v-model="sub_category_ckbox_statuses[index].status" v-on:click="click_sub_category_btn(sub_category.id)">
                {{ sub_categories[index]["is_checked"] }}
            </label>
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
            },
            num: {
                requires: true
            }
        },
        data() {
            return {
                sub_category_ckbox_statuses: this.get_sub_category_ckbox_statuses()
            };
        },
        methods: {
            click_sub_category_btn: function (id) {
                for(let i=0; i<this.sub_categories.length; i++)
                {
                    if(this.sub_categories[i].id === id && this.sub_category_ckbox_statuses[i].status === false)
                    {
                        this.sub_category_ckbox_statuses[i].status = true;
                        break;

                    }else if(this.sub_categories[i].id === id && this.sub_category_ckbox_statuses[i].status === true)
                    {
                        this.sub_category_ckbox_statuses[i].status = false;
                        break;

                    };
                };
            },
            get_sub_category_ckbox_statuses: function () {
                let array = {};
                for(let i=0; i<this.sub_categories.length; i++)
                {
                    array[i] = {
                        id: this.sub_categories[i].id,
                        status: true
                    };
                }
                    
                return array;
            }
        }
    }

</script>