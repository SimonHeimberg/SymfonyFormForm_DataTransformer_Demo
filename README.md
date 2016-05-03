Form, problem with Transformers in Components of Forms
======================================================

Demo for http://stackoverflow.com/questions/36940228/getviewdata-vs-getnormdata-and-datatransformers-different-results-depending-o

In form field, the Transformers (View and Model) work as expected:
 * testSubmitValidData
  * submit($iViewData) ->[view-revTrans]-> $normData -> getNormData()
  * $normData ->[model-revTrans]-> $modelData -> getData()
  * $normData ->[view-trans]-> $viewData -> getViewData()
 * testSetData
  * create(..., $iData) -> $data -> getData()
  * $data ->[model-trans]-> $normData -> getNormData()
  * $normData ->[model-trans]-> $viewData -> getViewData()

as described in http://symfony.com/doc/current/cookbook/form/data_transformers.html#about-model-and-view-transformers

But inside a form:
 * testSubmitInForm
  * :+1: getData() returns $data
  * :-1: but getNormData() and getViewData() also return $data
 * testDataInForm
  * :+1: getData() returns $data
  * :-1: but getNormData() and getViewData() also return $data

For easy viewing of the effects, the demo transformers work like this
 * ModelTransformer
  * reverseTransform: append M
  * transform: append m
 * ViewTransformer
  * reverseTransform: append V
  * transform: append v

