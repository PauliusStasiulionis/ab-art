=== Contact Form 7 Modules ===
Tags: Contact Form 7, form, forms, contactform7, contact form, hidden fields, hidden, cf7, cforms ii, cforms, Contact Forms 7, Contact Forms, contacted, contacts
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: trunk
Contributors: katzwebdesign
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=zackkatz%40gmail%2ecom&item_name=Contact%20Form%207%20Modules&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8

Contact Form 7 - Add useful modules such as hidden fields and "send all fields" to the Contact Form 7 plugin

== Description ==

### Add Hidden Fields to Contact Form 7

The Contact Form 7 plugin has over <em>6.5 million</em> downloads, yet the great plugin still lacks a simple feature: <strong>hidden fields</strong>. This plugin adds hidden fields to Contact Form 7 once and for all.

#### Inserting dynamic values

You can also choose to have the value of the hidden field dynamically populated in your form when you are contacted. To do so, choose the "Default value" to be:

* `post_title` - Inserts the title of the post/page
* `post_category` - The categories of the post or page
* `post_url` - The URL of the post or page
* `post_author` - The author of the post or page
* `custom_field-[Name]` - The value of a post or page's custom field. If you had a custom field "Foo", you would use the following as the hidden field value: `custom_field-Foo`

<strong>You can also use a filter:</strong> hook into the `wpcf7_hidden_field_value` filter to modify the value of the hidden field  using <a href="http://codex.wordpress.org/Function_Reference/add_filter" rel="nofollow"><code>add_filter()</code></a>. If you know the ID of the input, you can also use the `wpcf7_hidden_field_value_[#ID]` filter.

Now, when someone contacts you using your Contact Form 7 contact form, you can have lots more information about their visit - and you'll see it when you receive the email that tells you you've been contacted.

### Easily Send All Submitted Fields At Once

####Save time setting up your form emails...and never miss a field!

One of the limitations of Contact Form 7 is that you need to manually add each field to generated emails. This means that if you update the form with a new field and forget to add it to your email message, you won't receive it in your email. <strong>No longer.</strong>.

Using the <strong>Send All Fields</strong> module, you simply need to add `[all-fields]` to your message, and you will receive every field submitted. If you use HTML formatting, the formatting even looks nice.

<h4>Visit the official <a href="http://www.seodenver.com/contact-form-7-hidden-fields/">Contact Form 7 Modules plugin page</a> for more support & additional information</h4>

== Installation ==

1. Upload plugin files to your plugins folder, or install using WordPress' built-in Add New Plugin installer
1. Activate the plugin
1. Edit a form in Contact Form 7
1. Choose "Hidden field" from the Generate Tag dropdown
1. Follow the instructions on the page

== Screenshots ==

1. The new Hidden fields tag generator

== Frequently Asked Questions == 

= What is the plugin license? =

* This plugin is released under a GPL license.

== Changelog ==

= 1.2.1 =
* Added support for checkboxes with Send All Fields (`[all-fields]`)

= 1.2 =
* Hidden fields are now displayed inside a hidden `<div>` instead of Contact Form 7's default `<p>`. This makes hidden fields more hidden :-)
* Added brand-new module: Send All Fields. Allows you to add a `[all-fields]` tag to your email message that includes every submitted field in one tag.

= 1.1.1 =
* Fixed `Parameter 1 to wpcf7_add_tag_generator_hidden() expected to be a reference, value given` error, <a href="http://www.seodenver.com/contact-form-7-hidden-fields/#comment-116384456"> as reported by BDN Online</a>

= 1.1 =
* Added support for using post titles as hidden fields
* Added support for using custom field values as hidden fields
* Added `wpcf7_hidden_field_value` filter to hook into using <a href="http://codex.wordpress.org/Function_Reference/add_filter" rel="nofollow"><code>add_filter()</code></a>

= 1.0 =
* Initial plugin release.

== Upgrade Notice ==

= 1.2.1 =
* Added support for checkboxes with Send All Fields (`[all-fields]`)

= 1.2 =
* Hidden fields are now displayed inside a hidden `<div>` instead of Contact Form 7's default `<p>`. This makes hidden fields more hidden :-)
* Added brand-new module: Send All Fields. Allows you to add a `[all-fields]` tag to your email message that includes every submitted field in one tag.

= 1.1.1 =
* Fixed `Parameter 1 to wpcf7_add_tag_generator_hidden() expected to be a reference, value given` error, <a href="http://www.seodenver.com/contact-form-7-hidden-fields/#comment-116384456"> as reported by BDN Online</a>

= 1.1 =
* Added support for using post titles as hidden fields
* Added support for using custom field values as hidden fields
* Added `wpcf7_hidden_field_value` filter to hook into using <a href="http://codex.wordpress.org/Function_Reference/add_filter" rel="nofollow"><code>add_filter()</code></a>

= 1.0 = 
* Woot!