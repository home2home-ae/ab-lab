# A/B Lab

### Problem and Why this ?

- A/B Testing is hard.
- Launching features for selective group of customers is hard.
- Launching features for merchant, different localities is hard, specially when your codebase grows.

### Approach from experience

This is an approach, I learned over the years to solve specifically this issue

In the web UI, we will be adding features schema, which later will be cached to REDIS for higher performance. It will
require accessors for other packages. I'll put all the codes how we will implement and you be the judge if it suits your
needs.

### Design Approach

- Using sqlite for authentication and features to keep it lightweight
- Using REDIS to store features and treatments schema.

### Enhancements / Todo

- [ ] Add metrics and fatals to check if and when users are crashing.
- [ ] Right now there is no regionalization, we can add regionalization.

### License

This is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Contact

rehan_manzoor@outlook.com (I'll reply if I'm not working for 14-16 hours a day.)


