<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined('evalApp2_debug')){define('evalApp2_debug',true);}//for error reporting in html
include_once realpath(dirname(__FILE__) . '/eval/app.php'); //if you don't use realpath(dirname(__FILE__) . ' ' ) and this file is included and not run directly you are going to have a bad time.

$eval_god = new \evalApp2\app(); // make god object
eval($eval_god(
        [
            'profile' => ['soup'] // array of class names in the eval folder to be created in the current scope. In this example the folder will be searched for soup.php and an object will be created from that class with the name of $eval_soup
        ]));
//create word list identified with funlist, containing the words fun interesting and easy
$eval_soup->words('funlist',['fun','interesting','easy']);

//when no list of words is passed in the second parameter function will return a random word from the word list.
echo 'Making a website with evalApp2 is ' . $eval_soup->words('funlist') . '. <br>';

//creates a sentence list with alternate versions of the same sentence meaning.
$eval_soup->sentences('thing',[
    'Learning PHP with evalApp2 is ~funlist~.', //to use a word list put ~ ~ around the words id
    '~+funlist~ is what developing in PHP is, but it is also ~funlist~.' //useing a + option in front of the words id will uppercase the first letter. Please note that using the same word list in a sentence does not guarantee a unique word every time.
    ]);
echo $eval_soup->sentences('thing'); //sentences will also return a single sentence but parsed with the wordlists

$eval_soup->sentences('thing2',[
    'Learning without evalApp2 is not ~funlist~.',
    'Programming without evalApp2 is not ~funlist~'
]);

//turn the sentences into a paragraph
$paragraph_options = [
    'mode' => 'shuffle', //shuffle mode will shuffle all the sentences before applying visibility rules
    'sentences' => [
        'thing', //when the sentence identifier is passed only the assumed visibility will be 100%. This sentence will show up 100% of the time
        'thing2,70' // when the visibility is set by putting a , then a number the number will be the percentage of time the sentence will appear. In this case it will be 70% of the time
    ]
    ];
$eval_soup->paragraphs('paragraph1',$paragraph_options);

echo $eval_soup->paragraphs('paragraph1') . '<br>'; // passing the id without any options will return the constructed paragraph our of sentence lists

$paragraph_options['mode'] = 'sequence'; //sequence mode will display sentences in the sequential order that they were in the array.
$eval_soup->paragraphs('paragraph1', $paragraph_options);
echo $eval_soup->paragraphs('paragraph1');

echo $eval_soup->words('able'); // if you try to call a word list that doesn't exist it will then search the stored 

$eval_soup->words('fruit',['apple', 'banana']);

$eval_soup->sentences('fruit',[
    'I am not ~able~ to eat ~@fruit~', // option @ will check if the word begins with a vowel in order to choose the correct a or an.
    'This ~fruit~ has ~able~ benefits' // Use the auto-generated outside word lists as an adjective prefereable. Or you are going to have a bad time.
]);
echo "<br>";
echo $eval_soup->sentences('fruit');
