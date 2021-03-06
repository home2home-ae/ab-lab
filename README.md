<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/rummykhan/ab-lab/master/public/assets/img/icon-pack/logo.png" width="400"></a></p>


# A/B Lab

---
**DISCLAIMER**

It's still a work in progress, please see checklist before you make a decision.

---

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

### Checklist

- [x] Add root user authentication
- [x] Add feature adding with treatments, allocation
- [x] Add treatment assignment overrides
- [x] Add regular user page
- [x] Add change password page
- [x] Create A/B web logo
- [ ] Write tests
- [x] Write REDIS caching implementation
- [x] Use horizon jobs
- [x] Write A/B Lab Accessor (PHP/Laravel)
    - [ ] Accessor should cache the results
- [ ] Move this app to Production and post benchmarks (latency vs usability)

### Enhancements / Todo

- [x] Add enable / disable treatment overrides (right now it's by default enabled)
- [ ] Add metrics and fatals to check if and when users are crashing.
- [ ] Right now there is no regionalization, we can add regionalization..
- [ ] Move Frontend to Vue JS instead of Blade (Although I love both..)

### Deployment Plan

My initial deployment plan is to deploy this application in the apps vicinity (same VPS perhaps), later I'll improve on
it.

### License

This is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Contact

rehan_manzoor@outlook.com (I'll reply if I'm not working for 14-16 hours a day.)


