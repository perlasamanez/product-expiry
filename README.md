# product-expiry

From DevPost,

Inspiration:
After throwing away a bagful of vegetables and starving for the following week, we decided to have more control on our food and expiration dates in a convenient way and at the same time learning more about databases and servers. Also the Walmart App influenced our laziness.

What it does:
This Web App will receive the UPC (Universal Product Code or barcode thingy) and will send this code to Walmart's Product Lookup API. Which we will later retrieve the name and a thumbnail of the product in question. The App will process the JASON response and display it along with magical expiration dates.

How we built it:
We first tried to follow the advice of creating the database in Contentful. We failed, so we moved on to Node.js with no prior Express/MongoDB experience. We failed miserably at that too so we ended up using old fashion PHP.

Challenges we ran into:
As I mentioned before, we had very little knowledge of Node.js, Web servers and databases.

Accomplishments that we're proud of:
We actually had something running! We definitely didn't expect to have something ready. oh well.

What we learned:
We learned tons on API's in general! We also learned that there are a million ways to do what we wanted to do! frustrating right now (Because of the lack of sleep lol) but it motivate us to implement even more stuff in the future!

What's next for Expiry:
When we first arrived to SwampHacks we just intented to get a response from Walmart with some functionality. However, after meeting the sponsors at the SwampTank, my mind was blown with the cool tools they use and recommended. Now that we have a somewhat stable framework now we can venture into adding more functionality eg. OCR for receipts, sending notifications to other Apps, Recording costs for personal budgeting options, you name it!

